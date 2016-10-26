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
    $totalVotes = $topic->poll()->totalVotes();
    if ($totalVotes === 0) {
        $totalVotes = 1;
    }

    $percentage = sprintf('%.2f%%', 100.0 * $pollOption->poll_option_total / $totalVotes);
    $voted = $pollOption->userHasVoted(Auth::user());
?>

<tr class="forum-poll-row {{ $voted ? 'forum-poll-row--voted' : '' }}">
    <td class="forum-poll-row__column forum-poll-row__column--option-text">
        <label class="forum-poll-row__option-text-container">
            @if (priv_check('ForumTopicVote', $topic)->can())
                <div class="osu-checkbox">
                    <input
                        class="osu-checkbox__input"
                        type="{{ $topic->poll_max_options == 1 ? 'radio' : 'checkbox' }}"
                        value="{{ $pollOption->poll_option_id }}"
                        name="forum_topic_vote[option_ids][]"
                        {{ $pollOption->userHasVoted(Auth::user()) ? 'checked' : '' }}
                    >
                    <span class="osu-checkbox__tick">
                        <i class="fa fa-fw fa-{{ $topic->poll_max_options == 1 ? 'circle' : 'check' }}"></i>
                    </span>
                </div>
            @endif

            <span class="forum-poll-row__option-text">
                {{ $pollOption->poll_option_text }}
            </span>
        </label>
    </td>

    <td class="forum-poll-row__column forum-poll-row__column--bar">
        <div class="bar bar--forum-poll {{ $voted ? 'bar--forum-poll-voted' : '' }}">
            <div class="bar__fill" style="width: {{ $percentage }}">
            </div>
        </div>
    </td>

    <td class="forum-poll-row__column forum-poll-row__column--percentage">
        {{ $percentage }}
    </td>

    <td class="forum-poll-row__column">
        {{ $pollOption->poll_option_total }}
    </td>
</tr>
