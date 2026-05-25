{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="counter-box counter-box--info">
    <div class="counter-box__title">
        {{ osu_trans('forum.topics.show.total_watches') }}
    </div>

    <div class="counter-box__count js-forum__total-watches">
        {{ i18n_number_format($topic->watches()->count()) }}
    </div>
</div>
