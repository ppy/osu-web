{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
