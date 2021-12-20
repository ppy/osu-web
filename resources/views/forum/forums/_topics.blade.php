{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if (count($topics) === 0)
    <li class="forum-topic-entry">
        {{ osu_trans('forum.forums.topics.empty') }}
    </li>
@else
    @foreach($topics as $topic)
        @include($row ?? 'forum.forums._topic')
    @endforeach
@endif
