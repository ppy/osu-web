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
            {{ trans('forum.topics.show.poll.detail.total', ['count' => $pollSummary['total']]) }}
        </div>

        @if ($topic->pollEnd() !== null)
            <div class="forum-poll__detail forum-poll__detail--sub">
                @if ($topic->pollEnd()->isFuture())
                    {{ trans('forum.topics.show.poll.detail.end_time', ['time' => i18n_time($topic->pollEnd())]) }}
                @else
                    {{ trans('forum.topics.show.poll.detail.ended', ['time' => i18n_time($topic->pollEnd())]) }}
                @endif
            </div>

            @if (!$canViewResults)
                <div class="forum-poll__detail forum-poll__detail--sub">
                    {{ trans('forum.topics.show.poll.detail.results_hidden') }}
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
                            {{ trans('forum.topics.show.poll.button.change_vote') }}
                        @else
                            {{ trans('forum.topics.show.poll.button.vote') }}
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
                        {{ trans('forum.topics.show.poll.button.edit') }}
                    </button>
                </div>
            @endif
        </div>
    @endif
</div>
