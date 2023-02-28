{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $total = $newTopic ? 1 : $topic->postCount();
@endphp
<div class="counter-box counter-box--info">
    <div class="counter-box__title">
        {{ osu_trans('forum.topics.show.total_posts') }}
    </div>

    <div data-total="{{ $total }}" class="counter-box__count js-forum__total-count">
        {{ i18n_number_format($total) }}
    </div>
</div>
