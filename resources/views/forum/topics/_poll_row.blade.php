{{--
    Copyright 2016 ppy Pty. Ltd.

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
<?php
    $_percentage = sprintf('%.2f%%', 100.0 * $pollOption->poll_option_total / $topic->poll()->totalVotes());
?>

<tr class="forum-poll-row {{ $pollOption->userHasVoted(Auth::user()) ? 'forum-poll-row--voted' : '' }}">
    <td class="forum-poll-row__column forum-poll-row__column--option-text">
        <label class="forum-poll-row__option-text-container">
            <div class="osu-checkbox">
                @if (priv_check('ForumTopicVote', $topic)->can())
                    <input
                        class="osu-checkbox__input"
                        type="{{ $topic->poll_max_options == 1 ? 'radio' : 'checkbox' }}"
                        value="{{ $pollOption->poll_option_id }}"
                        name="forum_topic_vote[option_ids][]"
                        {{ $pollOption->userHasVoted(Auth::user()) ? 'checked' : '' }}
                    >
                    <span class="osu-checkbox__tick">
                        <i class="fa fa-{{ $topic->poll_max_options == 1 ? 'circle' : 'check' }}"></i>
                    </span>
                @endif
            </div>

            <span class="forum-poll-row__option-text">
                {{ $pollOption->poll_option_text }}
            </span>
        </label>
    </td>

    <td class="forum-poll-row__column forum-poll-row__column--bar">
        <div class="forum-poll-row__bar-container">
            <div class="forum-poll-row__bar" style="width: {{ $_percentage }}">
            </div>
        </div>
    </td>

    <td class="forum-poll-row__column forum-poll-row__column--percentage">
        {{ $_percentage }}
    </td>

    <td class="forum-poll-row__column">
        {{ $pollOption->poll_option_total }}
    </td>
</tr>
