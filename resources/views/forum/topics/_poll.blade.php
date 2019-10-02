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
    $canEditPoll = $canEditPoll ?? false;
    $canViewResults = priv_check('ForumTopicPollShowResults', $topic)->can();
    $voted = $topic->poll()->votedBy(auth()->user());
    $canVote = priv_check('ForumTopicVote', $topic)->can();

    $startingPage = ($voted || !$canVote) ? 'results' : 'form';

    $resultsButtons = [
        'vote' => $canVote && !$voted,
        'changeVote' => $canVote && $voted,
        'editPoll' => $canEditPoll,
    ];

    $formButtons = [
        'vote' => $canVote,
        'viewResults' => $canViewResults,
        'editPoll' => $canEditPoll,
    ];
@endphp
<div
    class="js-forum-poll--container forum-poll-container"
    data-page="{{ $startingPage }}"
    data-edit="0"
>
    <div class="forum-poll-container__content forum-poll-container__content--results">
        @include('forum.topics._poll_results', [
            'buttons' => $resultsButtons,
            'canEditPoll' => $canEditPoll,
            'canViewResults' => $canViewResults,
            'pollSummary' => $pollSummary,
            'topic' => $topic,
        ])
    </div>

    @if ($canVote)
        <div class="forum-poll-container__content forum-poll-container__content--form">
            @include('forum.topics._poll_form', [
                'buttons' => $formButtons,
            ])
        </div>
    @endif

    @if ($canEditPoll)
        <div class="forum-poll-container__content forum-poll-container__content--edit">
            @include('forum.topics._edit_poll')
        </div>
    @endif
</div>
