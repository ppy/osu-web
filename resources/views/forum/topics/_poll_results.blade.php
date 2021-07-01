{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="forum-poll">
    <div class="forum-poll__row forum-poll__row--title">
        <h2 class="forum-poll__title">
            {!! $topic->pollTitleHTML() !!}
        </h2>
    </div>

    <div class="forum-poll__row forum-poll__row--options">
        @foreach ($pollSummary['options'] as $pollOptionId => $pollOption)
            @include('forum.topics._poll_row', compact('pollOptionId', 'pollOption', 'pollSummary'))
        @endforeach
    </div>

    <div class="forum-poll__row forum-poll__row--details">
        <div class="forum-poll__detail">
            {{ osu_trans('forum.topics.show.poll.detail.total', ['count' => $pollSummary['total']]) }}
        </div>

        @if ($topic->pollEnd() !== null)
            <div class="forum-poll__detail forum-poll__detail--sub">
                @if ($topic->pollEnd()->isFuture())
                    {!! osu_trans('forum.topics.show.poll.detail.end_time', ['time' => js_localtime($topic->pollEnd())]) !!}
                @else
                    {!! osu_trans('forum.topics.show.poll.detail.ended', ['time' => js_localtime($topic->pollEnd())]) !!}
                @endif
            </div>

            @if (!$canViewResults)
                <div class="forum-poll__detail forum-poll__detail--sub">
                    {{ osu_trans('forum.topics.show.poll.detail.results_hidden') }}
                </div>
            @endif
        @endif
    </div>

    @if (count($buttons) > 0)
        <div class="forum-poll__row forum-poll__row--buttons">
            @if ($buttons['changeVote'] || $buttons['vote'])
                <div class="forum-poll__button">
                    <button
                        type="button"
                        class="js-forum-poll--switch-page btn-osu-big btn-osu-big--forum-primary"
                        data-target-page="form"
                    >
                        @if ($buttons['changeVote'])
                            {{ osu_trans('forum.topics.show.poll.button.change_vote') }}
                        @else
                            {{ osu_trans('forum.topics.show.poll.button.vote') }}
                        @endif
                    </button>
                </div>
            @endif

            @if ($buttons['editPoll'])
                <div class="forum-poll__button">
                    <button
                        type="button"
                        class="js-forum-poll--switch-edit btn-osu-big btn-osu-big--forum-secondary"
                    >
                        {{ osu_trans('forum.topics.show.poll.button.edit') }}
                    </button>
                </div>
            @endif
        </div>
    @endif
</div>
