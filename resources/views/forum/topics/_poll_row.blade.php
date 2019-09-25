{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
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
