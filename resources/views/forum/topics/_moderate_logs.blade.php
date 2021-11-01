{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<a
    href="{{ route('forum.topics.logs.index', $topic->getKey()) }}"
    class="btn-circle btn-circle--topic-nav btn-circle--yellow"
    title="{{ osu_trans('forum.topic.logs.button') }}"
>
    <span class="btn-circle__content">
        <i class="fas fa-list"></i>
    </span>
</a>
