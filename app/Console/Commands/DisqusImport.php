<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\Build;
use App\Models\Comment;
use App\Models\NewsPost;
use App\Models\UpdateStream;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use League\HTMLToMarkdown\HtmlConverter;
use SQLite3;

class DisqusImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'disqus:import {--file=} {--usersdb=}';

    protected $converter;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports osu! website disqus dump.';

    private $threads = [];
    private $usersDBPath;
    private $usersDB;
    private $usersDBSearchStatement;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->usersDBPath = $this->option('usersdb') ?? '';

        $this->prepareUsersDB();

        $this->converter = new HtmlConverter();
        $this->converter->getConfig()->setOption('strip_tags', true);

        $file = $this->option('file');

        $xml = simplexml_load_file($file);

        $this->info('Processing threads');
        $bar = $this->output->createProgressBar(count($xml->thread));
        $bar->setRedrawFrequency(10);

        foreach ($xml->thread as $thread) {
            $this->addThread($thread);
            $bar->advance();
        }

        $bar->finish();
        $this->info('');

        $this->info('Processing posts');
        $bar = $this->output->createProgressBar(count($xml->post));
        $bar->setRedrawFrequency(100);

        foreach ($xml->post as $post) {
            $this->createComment($post);
            $bar->advance();
        }

        $bar->finish();
        $this->info('');
    }

    private function addThread($thread)
    {
        $legacyId = (string) $thread->id;

        if ($legacyId === 'anonymized') {
            $legacyId = null;
        }

        $id = (int) $thread->attributes('dsq', true)->id;
        $link = (string) $thread->link;

        [$commentableType, $commentableId] =
            $this->findBeatmapset($legacyId, $link) ??
            $this->findBuild($legacyId) ??
            $this->findNewsPost($legacyId) ??
            [null, null];

        $data = [
            'id' => presence($legacyId) ?? $id.':'.$link,
            'link' => $link,
            'commentableType' => $commentableType,
            'commentableId' => $commentableId,
        ];

        $this->threads[$id] = $data;
    }

    private function findBeatmapset($legacyId, $link)
    {
        $id = null;

        static $prefix = 'beatmapset_';

        if (starts_with($legacyId, $prefix)) {
            $id = get_int(substr($legacyId, strlen($prefix)));
        } else {
            static $beatmapsetLinkId = '//osu.ppy.sh/s/';

            $beatmapsetLinkPos = strpos($link, $beatmapsetLinkId);

            if ($beatmapsetLinkPos !== false) {
                $id = get_int(substr($link, $beatmapsetLinkPos + strlen($beatmapsetLinkId)));
            }
        }

        if ($id !== null) {
            return ['beatmapset', $id];
        }
    }

    private function findBuild($legacyId)
    {
        static $buildPrefix = 'build_b';

        if (!starts_with($legacyId, $buildPrefix)) {
            return;
        }

        $versionAndStreamName = substr($legacyId, strlen($buildPrefix));
        $version = substr($versionAndStreamName, 0, 8);
        $streamName = substr($versionAndStreamName, 8);

        $buildQuery = Build::where('version', 'LIKE', "{$version}%");

        if ($streamName !== false) {
            $stream = UpdateStream::where(['name' => $streamName])->first();

            if ($stream !== null) {
                $buildQuery->where(['stream_id' => $stream->getKey()]);
            }
        }

        $build = $buildQuery->first();

        if ($build !== null) {
            return ['build', $build->getKey()];
        }
    }

    private function findNewsPost($legacyId)
    {
        if (!starts_with($legacyId, 'news_')) {
            return;
        }

        $tumblrIdOrSlug = substr($legacyId, 5);

        if (preg_match('/\D/', $tumblrIdOrSlug) === 0) {
            $column = 'tumblr_id';
        } else {
            $column = 'slug';
        }

        $newsPost = NewsPost::where([$column => $tumblrIdOrSlug])->first();

        if ($newsPost !== null) {
            return ['news_post', $newsPost->getKey()];
        }
    }

    private function createComment($post)
    {
        $disqusId = (int) $post->attributes('dsq', true)->id;
        $messageHtml = (string) $post->message;
        $message = mb_substr($this->converter->convert($messageHtml), 0, Comment::MESSAGE_LIMIT);
        $createdAt = Carbon::parse($post->createdAt);
        $deleted = ((string) $post->isDeleted) === 'true';
        $spam = ((string) $post->isSpam) === 'true';
        $deletedAt = $deleted || $spam ? $createdAt : null;
        $disqusUserData = [
            'username' => (string) $post->author->username,
            'name' => (string) $post->author->name,
        ];
        $userId = $this->lookupUserId($disqusUserData);
        if ($post->parent->getName() === 'parent') {
            $disqusParentId = (int) $post->parent->attributes('dsq', true)->id;
            $parentId = optional(Comment::where(['disqus_id' => $disqusParentId])->select('id')->first())->getKey();
        }
        $threadId = (int) $post->thread->attributes('dsq', true)->id;
        $threadData = $this->threads[$threadId] ?? null;

        $comment = new Comment([
            'user_id' => $userId,
            'message' => $message,
            'disqus_id' => $disqusId ?? null,
            'disqus_parent_id' => $disqusParentId ?? null,
            'disqus_thread_id' => $threadData['id'] ?? null,
            'disqus_user_data' => $disqusUserData,
            'deleted_at' => $deletedAt,
            'created_at' => $createdAt,
            'parent_id' => $parentId ?? null,
            'commentable_id' => $threadData['commentableId'],
            'commentable_type' => $threadData['commentableType'],
        ]);

        $comment->allowEmptyCommentable = true;

        try {
            $comment->save();
        } catch (Exception $e) {
            if (!is_sql_unique_exception($e)) {
                throw $e;
            }
        }
    }

    private function prepareUsersDB()
    {
        $this->usersDB = new SQLite3($this->usersDBPath);
        $this->usersDB->exec('CREATE TABLE IF NOT EXISTS user_mappings (hash STRING, id BIGINT)');
        $this->usersDB->exec('CREATE INDEX IF NOT EXISTS user_mappings_hash ON user_mappings (hash)');
        $this->usersDBSearchStatement = $this->usersDB->prepare('SELECT id FROM user_mappings WHERE hash = :hash');

        $maxId = User::max('user_id') ?? 1;
        $insertStatement = $this->usersDB->prepare('INSERT INTO user_mappings VALUES (:hash, :id)');

        $this->info('Generating user id mapping');
        $bar = $this->output->createProgressBar($maxId);
        $bar->setRedrawFrequency(1000);

        $i = 1 + ($this->usersDB->querySingle('SELECT MAX(id) FROM user_mappings') ?? 0);

        $bar->advance($i);

        $this->usersDB->exec('BEGIN');

        for ($i; $i <= $maxId; $i++) {
            $insertStatement->bindValue(':hash', 'osu-'.md5($i));
            $insertStatement->bindValue(':id', $i);
            $insertStatement->execute();
            $bar->advance();
        }

        $this->usersDB->exec('COMMIT');

        $bar->finish();
        $this->info('');
    }

    private function lookupUserId($userData)
    {
        if (starts_with($userData['username'], 'osu-')) {
            $this->usersDBSearchStatement->bindValue(':hash', $userData['username']);
            $rows = $this->usersDBSearchStatement->execute();
            $row = $rows->fetchArray();

            if (is_array($row)) {
                return $row['id'];
            }
        }
    }
}
