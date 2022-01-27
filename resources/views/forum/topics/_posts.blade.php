{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $postPosition = $firstPostPosition;
@endphp

@foreach($posts as $post)
    @php
        $deletePriv = priv_check('ForumPostDelete', $post);
        $withDeleteLink = $deletePriv->can() || $deletePriv->rawMessage() === 'forum.post.delete.only_last_post';

        if ($post->trashed() && $postPosition > 0 && !$loop->first) {
            $postPosition--;
        }

        // sync with:
        // - Post#isBeatmapsetPost (position check)
        // - Post#edit (option below)
        // - Post#delete (option below)
        $isBeatmapsetPost = $postPosition === 1 && $post->isBeatmapsetPost();
    @endphp
    @include('forum.topics._post', [
        'post' => $post,
        'options' => [
            'postPosition' => $postPosition,
            'signature' => $topic->forum->enable_sigs,

            'buttons' => [
                'delete' => !$isBeatmapsetPost && $withDeleteLink,
                'edit' => !$isBeatmapsetPost && priv_check('ForumPostEdit', $post)->can(),
                'quote' => priv_check('ForumTopicReply', $topic)->can(),
            ],
        ],
    ])
    @php
        $postPosition++;
    @endphp
@endforeach
