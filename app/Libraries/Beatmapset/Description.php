<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Beatmapset;

use App\Libraries\BBCodeFromDB;
use App\Models\Beatmapset;
use App\Models\Forum;
use App\Models\User;

class Description
{
    const BBCODE_OPTIONS = [
        'ignoreLineHeight' => true,
        'withGallery' => true,
    ];

    const SEPARATOR = '---------------';

    public function __construct(private readonly Beatmapset $beatmapset)
    {
    }

    public static function removeMetadataText(?string $text): string
    {
        // TODO: see if can be combined with description extraction thingy without
        // exploding
        return preg_replace('/^(.*?)-{15}/s', '', $text ?? '');
    }

    private static function splitText(Forum\Post $post): array
    {
        return explode(static::SEPARATOR, $post->post_text ?? '', 2);
    }

    public function bbcode(): BBCodeFromDB
    {
        $post = $this->beatmapset->descriptionPost ?? new Forum\Post();
        $description = trim(static::splitText($post)[1] ?? '');

        return new BBCodeFromDB($description, $post->bbcode_uid, static::BBCODE_OPTIONS);
    }

    public function update(string $bbcode, User $user): bool
    {
        return \DB::transaction(function () use ($bbcode, $user) {
            $post = $this->beatmapset->descriptionPost;

            if ($post === null) {
                $forum = Forum\Forum::findOrFail($GLOBALS['cfg']['osu']['forum']['beatmap_description_forum_id']);
                $title = $this->beatmapset->artist.' - '.$this->beatmapset->title;

                $topic = Forum\Topic::createNew($forum, [
                    'title' => mb_substr($title, 0, 100),
                    'user' => $user,
                    'body' => static::SEPARATOR,
                ]);
                // allow up to 255 characters title. The actual maximum length
                // is 163 due to 80 characters limit for artist and title.
                if (mb_strlen($title) > 100) {
                    Forum\Topic::whereKey($topic->getKey())->update(['topic_title' => mb_substr($title, 0, 255)]);
                }
                $topic->lock();
                $this->beatmapset->update(['thread_id' => $topic->getKey()]);
                $post = $topic->firstPost;
            }

            $split = static::splitText($post);

            $header = new BBCodeFromDB($split[0], $post->bbcode_uid, static::BBCODE_OPTIONS);
            $newBody = $header->toEditor().static::SEPARATOR."\n".ltrim($bbcode);

            return $post
                ->skipBeatmapPostRestrictions()
                ->update([
                    'post_text' => $newBody,
                    'post_edit_user' => $user->getKey(),
                ]);
        });
    }
}
