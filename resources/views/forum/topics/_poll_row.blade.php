{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $percentage = $pollOption['total'] / max($pollSummary['total'], 1);
    $percentageFormatted = i18n_number_format($percentage, NumberFormatter::PERCENT, null, 2);
    $percentageStyle = i18n_number_format($percentage, NumberFormatter::PERCENT, null, 2, 'en');
@endphp
<div class="forum-poll-row {{ $pollOption['voted_by_user'] ? 'forum-poll-row--voted' : '' }}">
    <div class="forum-poll-row__row forum-poll-row__row--content">
        <div class="forum-poll-row__text">
            {!! $pollOption['textHTML'] !!}
        </div>

        @if ($canViewResults)
            <div class="forum-poll-row__result forum-poll-row__result--total">
                {{ $pollOption['total'] }}
            </div>

            <div class="forum-poll-row__result forum-poll-row__result--percentage">
                {{ $percentageFormatted }}
            </div>
        @endif
    </div>

    <div class="forum-poll-row__row forum-poll-row__row--content">
        <div class="bar bar--forum-poll {{ $pollOption['voted_by_user'] ? 'bar--forum-poll-voted' : '' }}">
            <div
                class="bar__fill"
                style="width: {{ $canViewResults ? $percentageStyle : '100%' }}"
            >
            </div>
        </div>
    </div>
</div>
