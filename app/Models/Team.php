<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use App\Exceptions\InvariantException;
use App\Jobs\EsDocument;
use App\Jobs\Notifications\TeamApplicationAccept;
use App\Libraries\BBCodeForDB;
use App\Libraries\Elasticsearch\Indexable;
use App\Libraries\Transactions\AfterCommit;
use App\Libraries\Uploader;
use App\Libraries\User\Cover as UserCover;
use App\Libraries\UsernameValidation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model implements AfterCommit, Indexable, Traits\ReportableInterface
{
    use Traits\Es\TeamSearch, Traits\Reportable;

    const FLAG_MAX_DIMENSIONS = [512, 256];

    const MAX_FIELD_LENGTHS = [
        'description' => 63000,
        'name' => 100,
        'short_name' => 4,
        'url' => 255,
    ];

    protected $casts = ['is_open' => 'bool'];

    private Uploader $header;
    private Uploader $flag;

    private static function sanitiseName(?string $value): ?string
    {
        return presence(preg_replace('/  +/', ' ', trim($value ?? '')));
    }

    public function applications(): HasMany
    {
        return $this->hasMany(TeamApplication::class);
    }

    public function channel(): BelongsTo
    {
        return $this->belongsTo(Chat\Channel::class, 'channel_id');
    }

    public function leader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(TeamMember::class);
    }

    public function statistics(): HasMany
    {
        return $this->hasMany(TeamStatistics::class);
    }

    public function setDefaultRulesetIdAttribute(?int $value): void
    {
        $this->attributes['default_ruleset_id'] = Beatmap::MODES[Beatmap::modeStr($value) ?? 'osu'];
    }

    public function setFlagAttribute(?string $value): void
    {
        if ($value !== null) {
            $this->flag()->set($value);
        }
    }

    public function setHeaderAttribute(?string $value): void
    {
        if ($value !== null) {
            $this->header()->set($value);
        }
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['name'] = static::sanitiseName($value);
    }

    public function setShortNameAttribute(?string $value): void
    {
        $this->attributes['short_name'] = static::sanitiseName($value);
    }

    public function setUrlAttribute(?string $value): void
    {
        $this->attributes['url'] = $value === null
            ? null
            : (is_http($value)
                ? $value
                : "https://{$value}"
            );
    }

    public function addMember(TeamApplication $application): void
    {
        $this->getConnection()->transaction(function () use ($application) {
            $application->delete();
            $this->members()->create(['user_id' => $application->getKey()]);
            $this->channel->addUser($application->user);
        });

        (new TeamApplicationAccept($application, $this->leader))->dispatch();
    }

    public function afterCommit(): void
    {
        dispatch(new EsDocument($this));
    }

    public function createChannel(): Chat\Channel
    {
        if ($this->channel !== null) {
            return $this->channel;
        }

        $channel = new Chat\Channel([
            'name' => truncate($this->name, 50),
            'type' => Chat\Channel::TYPES['team'],
        ]);
        $channel->saveOrExplode();
        $this->channel()->associate($channel);

        return $channel;
    }

    public function delete()
    {
        $this->header()->delete();
        $this->flag()->delete();

        return $this->getConnection()->transaction(function () {
            return (new Chat\Channel())->getConnection()->transaction(function () {
                $ret = parent::delete();

                if ($ret) {
                    $this->applications()->delete();
                    $this->members()->delete();
                    $this->statistics()->delete();

                    $channel = $this->channel;
                    if ($channel !== null) {
                        $channel->loadMissing('userChannels.user');

                        foreach ($channel->userChannels as $userChannel) {
                            $user = $userChannel->user;
                            if ($user === null) {
                                $userChannel->delete();
                            } else {
                                $channel->removeUser($user);
                            }
                        }

                        if ($channel->messages()->count() === 0) {
                            $channel->delete();
                        } else {
                            $channel->update(['name' => "#DeletedTeam_{$this->getKey()}"]);
                        }
                    }
                }

                return $ret;
            });
        });
    }

    public function descriptionHtml(): string
    {
        $description = presence($this->description);

        return $description === null
            ? ''
            : bbcode((new BBCodeForDB($description))->generate());
    }

    public function emptySlots(): int
    {
        $max = $this->maxMembers();
        $current = $this->members->count();

        return $max - $current;
    }

    public function flag(): Uploader
    {
        return $this->flag ??= new Uploader(
            'teams/flag',
            $this,
            'flag_file',
            ['image' => [
                'maxDimensions' => static::FLAG_MAX_DIMENSIONS,
                'maxFilesize' => 200_000,
            ]],
        );
    }

    public function header(): Uploader
    {
        return $this->header ??= new Uploader(
            'teams/header',
            $this,
            'header_file',
            ['image' => [
                'maxDimensions' => UserCover::CUSTOM_COVER_MAX_DIMENSIONS,
                'maxFilesize' => UserCover::CUSTOM_COVER_MAX_FILESIZE,
            ]],
        );
    }

    public function isValid(): bool
    {
        $this->validationErrors()->reset();

        $wordFilters = app('chat-filters');
        foreach (['name', 'short_name'] as $field) {
            $value = $this->$field;
            if ($value === null) {
                $this->validationErrors()->add($field, 'required');
            } elseif ($this->isDirty($field)) {
                // printable ascii characters
                if (!preg_match('/^[ -~]+$/', $value)) {
                    $this->validationErrors()->add($field, '.invalid_characters');
                } elseif (!$wordFilters->isClean($value) || !UsernameValidation::allowedName($value)) {
                    $this->validationErrors()->add($field, '.word_not_allowed');
                } elseif (static::whereNot('id', $this->getKey())->where($field, $value)->exists()) {
                    $this->validationErrors()->add($field, '.used');
                }
            }
        }

        $this->validateDbFieldLengths();

        if ($this->isDirty('url')) {
            $url = $this->url;
            if ($url !== null && !is_http($url)) {
                $this->validationErrors()->add('url', 'url');
            }
        }

        if ($this->isDirty('ruleset_id')) {
            if (Beatmap::modeStr($this->ruleset_id) === null) {
                $this->validationErrors()->add('ruleset_id', '.unknown_ruleset_id');
            }
        }

        return $this->validationErrors()->isEmpty();
    }

    public function leaderOrDeleted(): User
    {
        $leader = $this->leader;

        return $leader === null || $leader->isRestricted()
            ? new DeletedUser(['user_id' => $this->leader_id])
            : $leader;
    }

    public function maxMembers(): int
    {
        $this->loadMissing('members.user');

        $supporterCount = $this->members->filter(fn ($member) => $member->user?->isSupporter() ?? false)->count();

        return min(8 + (4 * $supporterCount), $GLOBALS['cfg']['osu']['team']['max_members']);
    }

    public function removeMember(TeamMember $member): void
    {
        if ($member->user_id === $this->leader_id) {
            throw new InvariantException('can not remove leader from the team');
        }

        $this->getConnection()->transaction(function () use ($member) {
            $member->delete();
            $user = $member->user;
            if ($user !== null) {
                $this->channel->removeUser($user);
            }
        });
    }

    public function save(array $options = [])
    {
        if (!$this->isValid()) {
            return false;
        }

        if (!$this->exists) {
            return $this->getConnection()->transaction(function () use ($options) {
                return (new Chat\Channel())->getConnection()->transaction(function () use ($options) {
                    $this->channel_id ??= 0;
                    $this->default_ruleset_id ??= $this->leader->osu_playmode;
                    $saved = parent::save($options);

                    if ($saved) {
                        $this->members()->create(['user_id' => $this->leader_id]);

                        $channel = $this->createChannel();
                        $channel->addUser($this->leader);

                        $this->flag()->updateFile();
                        $this->header()->updateFile();
                    }

                    return parent::save($options);
                });
            });
        }

        $this->flag()->updateFile();
        $this->header()->updateFile();

        return parent::save($options);
    }

    public function trashed(): bool
    {
        return false;
    }

    public function url(): string
    {
        return route('teams.show', ['team' => $this->getKey()]);
    }

    public function validationErrorsTranslationPrefix(): string
    {
        return 'team';
    }

    protected function newReportableExtraParams(): array
    {
        return [
            'reason' => 'UnwantedContent',
            'user_id' => $this->leader_id,
        ];
    }
}
