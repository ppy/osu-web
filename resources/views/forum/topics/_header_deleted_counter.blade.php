{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if (!$newTopic && $topic->deletedPostsCount() > 0)
    @php
        $total = $newTopic ? 0 : $topic->deletedPostsCount();
    @endphp
    <div class="counter-box counter-box--info">
        <div class="counter-box__title">
            {{ osu_trans('forum.topics.show.deleted-posts') }}
        </div>

        <div data-total="{{ $total }}" class="counter-box__count js-forum__deleted-count">
            {{ i18n_number_format($total) }}
        </div>
    </div>
@endif
