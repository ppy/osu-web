{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    // assume index page if $forum not set
    $isIndex = !isset($forum);

    if ($isIndex) {
        $links = [
            [
                'title' => osu_trans('forum.forums.index.title'),
                'url' => route('forum.forums.index'),
            ]
        ];
    } else {
        $links = [];
        $links[] = [
            'title' => osu_trans('forum.title'),
            'url' => route('forum.forums.index'),
        ];

        foreach ($forum->forum_parents as $forumId => $forumData) {
            $url = $forumData[1] === 0
                ? route('forum.forums.index').'#forum-'.$forumId
                : route('forum.forums.show', $forumId);
            $title = $forumData[0];

            $links[] = compact('title', 'url');
        }

        $links[] = [
            'title' => $forum->forum_name,
            'url' => route("forum.forums.show", $forum->forum_id),
        ];

        if (isset($additionalLinks)) {
            foreach ($additionalLinks as $link) {
                $links[] = [
                    'title' => $link['title'],
                    'url' => $link['url'] ?? null,
                ];
            }
        }
    }
@endphp
@include('layout._page_header_v4', ['params' => [
    'backgroundExtraClass' => 'js-forum-cover--header',
    'backgroundImage' => $background ?? null,
    'headerExtraClass' => 'js-header--main',
    'links' => $links,
    'linksBreadcrumb' => true,
    'theme' => $isIndex ? 'forums-index' : 'forum',
]])
