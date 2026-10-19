{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $percentage = $pollOption['total'] / max($pollSummary['total'], 1);
    $percentageFormatted = i18n_number_format($percentage, NumberFormatter::PERCENT, null, 2);
    $percentageStyle = i18n_number_format($percentage, NumberFormatter::PERCENT, null, 2, 'en');
    $isTop = $canViewResults && $pollOption['total'] === $pollSummary['top_votes'];
@endphp
<div class="{{ class_with_modifiers('forum-poll-row', ['top' => $isTop]) }}">
    <div class="forum-poll-row__row forum-poll-row__row--content">
        <div class="forum-poll-row__text">
            @if ($pollOption['voted_by_user'])
                <span class="fas fa-check-circle"></span>
            @endif
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
        <div class="bar bar--forum-poll">
            <div
                class="bar__fill"
                style="width: {{ $canViewResults ? $percentageStyle : '100%' }}"
            >
            </div>
        </div>
    </div>
</div>
