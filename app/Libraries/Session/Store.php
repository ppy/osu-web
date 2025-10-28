<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Session;

use App\Events\UserSessionEvent;
use App\Interfaces\SessionVerificationInterface;
use App\Libraries\Agent;
use Illuminate\Redis\Connections\PhpRedisConnection;
use Illuminate\Session\Store as BaseStore;
use Illuminate\Support\Arr;

class Store extends BaseStore implements SessionVerificationInterface
{
    private const PREFIX = 'sessions:';

    public static function batchDelete(?int $userId, ?array $ids = null): void
    {
        $ids ??= static::ids($userId);

        if (empty($ids)) {
            return;
        }

        $currentSession = \Session::instance();
        if (in_array($currentSession->getId(), $ids, true)) {
            $currentSession->flush();
        }

        $redis = self::redis();
        $redis->del($ids);
        if ($userId !== null) {
            $idsForEvent = self::keysForEvent($ids);
            // Also delete ids that were previously stored with prefix which is
            // the full redis key just like for event.
            $redis->srem(self::listKey($userId), ...$ids, ...$idsForEvent);
            UserSessionEvent::newLogout($userId, $idsForEvent)->broadcast();
        }
    }

    public static function findForVerification(string $id): static
    {
        return static::findOrNew($id);
    }

    public static function findOrNew(?string $id = null): static
    {
        if ($id !== null) {
            $currentSession = \Session::instance();

            if ($currentSession->getId() === $id) {
                return $currentSession;
            }
        }

        $ret = (new SessionManager(\App::getInstance()))->instance();
        if ($id !== null) {
            $ret->setId($id);
        }
        $ret->start();

        return $ret;
    }

    public static function ids(?int $userId): array
    {
        return $userId === null
            ? []
            : array_map(
                // The ids were previously stored with prefix.
                fn ($id) => str_starts_with($id, 'osu-next:') ? substr($id, 9) : $id,
                self::redis()->smembers(self::listKey($userId)),
            );
    }

    public static function keyForEvent(string $id): string
    {
        // TODO: use config's database.redis.session.prefix (also in notification-server)
        return "osu-next:{$id}";
    }

    public static function keysForEvent(array $ids): array
    {
        return array_map(static::keyForEvent(...), $ids);
    }

    public static function sessions(int $userId): array
    {
        $ids = static::ids($userId);
        if (empty($ids)) {
            return [];
        }

        $sessions = array_combine(
            $ids,
            // Sessions are stored double-serialized in redis (session serialization + cache backend serialization)
            array_map(
                fn ($s) => $s === null ? null : unserialize(unserialize($s)),
                self::redis()->mget($ids),
            ),
        );

        // Current session data in redis may be stale
        $currentSession = \Session::instance();
        if ($currentSession->userId() === $userId) {
            $sessions[$currentSession->getId()] = $currentSession->attributes;
        }

        $sessionMeta = [];
        $agent = new Agent();
        $agent->setUserAgent(\Request::header('User-Agent'));
        $expiredIds = [];
        foreach ($sessions as $id => $session) {
            if ($session === null) {
                $expiredIds[] = $id;
                continue;
            }

            if (!isset($session['meta'])) {
                continue;
            }

            $meta = $session['meta'];
            $agent->setUserAgent($meta['agent']);

            $sessionMeta[$id] = [
                ...$meta,
                'mobile' => $agent->isMobile() || $agent->isTablet(),
                'device' => $agent->device(),
                'platform' => $agent->platform(),
                'browser' => $agent->browser(),
                'verified' => (bool) ($session['verified'] ?? false),
            ];
        }

        // cleanup expired sessions
        static::batchDelete($userId, $expiredIds);

        // returns sessions sorted from most to least recently active
        return Arr::sortDesc(
            $sessionMeta,
            fn ($value) => $value['last_visit'],
        );
    }

    /**
     * Get the redis key containing the session list for the given user.
     */
    private static function listKey(int $userId): string
    {
        return static::PREFIX.$userId;
    }

    private static function redis(): PhpRedisConnection
    {
        return \LaravelRedis::connection($GLOBALS['cfg']['session']['connection']);
    }

    public function delete(): void
    {
        static::batchDelete($this->userId(), [$this->getId()]);
    }

    public function getKey(): string
    {
        return $this->getId();
    }

    public function getKeyForEvent(): string
    {
        return self::keyForEvent($this->getId());
    }

    public function getVerificationMethod(): ?string
    {
        return $this->attributes['verification_method'] ?? null;
    }

    /**
     * Used to obtain the instance from Session facade or SessionManager instance
     */
    public function instance(): static
    {
        return $this;
    }

    public function isValidId($id)
    {
        // Overridden to allow prefixed id
        return is_string($id);
    }

    public function isVerified(): bool
    {
        return $this->attributes['verified'] ?? false;
    }

    public function markVerified(): void
    {
        $this->attributes['verified'] = true;
        $this->save();
    }

    /**
     * Generate a new session id.
     *
     * Overridden to delete session from redis - both entry and list.
     */
    public function migrate($destroy = false)
    {
        if ($destroy) {
            $userId = $this->userId();
            if ($userId !== null) {
                // Keep existing attributes
                $attributes = $this->attributes;
                static::batchDelete($userId, [$this->getId()]);
                $this->attributes = $attributes;
            }
        }

        return parent::migrate($destroy);
    }

    /**
     * Save the session data to storage.
     *
     * Overriden to track user sessions in Redis and shorten lifetime for guest sessions.
     */
    public function save()
    {
        $userId = $this->userId();

        if ($this->handler instanceof CacheBasedSessionHandler) {
            $this->handler->setMinutes($userId === null ? 120 : $GLOBALS['cfg']['session']['lifetime']);
        }

        parent::save();

        // TODO: move this to migrate and validate session id in readFromHandler
        if ($userId !== null) {
            self::redis()->sadd(self::listKey($userId), $this->getId());
        }
    }

    public function setVerificationMethod(string $method): void
    {
        $this->attributes['verification_method'] = $method;
        $this->save();
    }

    public function userId(): ?int
    {
        // From `Auth::getName()`.
        // Hardcoded because Auth depends on this class instance which then
        // calls this functions and would otherwise cause circular dependency.
        // Note that osu-notification-server also checks this key. Make sure
        // to also update it if the value changes.
        return $this->attributes['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'] ?? null;
    }

    protected function generateSessionId()
    {
        $userId = $this->userId();

        return self::PREFIX
            .($userId ?? 'guest')
            .':'
            .parent::generateSessionId();
    }

    /**
     * Read the session data from the handler.
     *
     * @return array
     */
    protected function readFromHandler()
    {
        // Overridden to force session ids to be regenerated when trying to load a session that doesn't exist anymore
        if ($data = $this->handler->read($this->getId())) {
            $data = @unserialize($this->prepareForUnserialize($data));

            if ($data !== false && !is_null($data) && is_array($data)) {
                return $data;
            }
        }

        $this->regenerate(true);

        return [];
    }
}
