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
{!! Form::open([
    'route' => ['forum.topics.vote', $topic->topic_id],
    'method' => 'POST',
    'data-remote' => true,
    'data-checkbox-validation' => json_encode([
        'forum_topic_vote[option_ids][]' => [
            'min' => 1,
            'max' => $topic->poll_max_options,
        ],
    ]),
    'class' => 'forum-poll js-checkbox-validation',
]) !!}
    <h2 class="forum-poll__row forum-poll__row--title">
        {{ $topic->poll_title }}
    </h2>

    <table class="forum-poll__row forum-poll__row--options">
        <tbody>
            @foreach ($topic->pollOptions as $pollOption)
                @include('forum.topics._poll_row', compact($pollOption))
            @endforeach
        </tbody>
    </table>

    <div class="forum-poll__row">
        <div class="forum-poll__detail">
            {{ trans('forum.topics.show.poll.detail.total', ['count' => $topic->poll()->totalVotes()]) }}
        </div>
    </div>

    @if ($topic->pollEnd() !== null)
        <div class="forum-poll__row">
            <div class="forum-poll__detail">
                @if ($topic->pollEnd()->isFuture())
                    {{ trans('forum.topics.show.poll.detail.end_time', ['time' => $topic->pollEnd()]) }}
                @else
                    {{ trans('forum.topics.show.poll.detail.ended', ['time' => $topic->pollEnd()]) }}
                @endif
            </div>
        </div>
    @endif

    <div class="forum-poll__row">
        @if (!priv_check('ForumTopicVote', $topic)->can())
            {{ priv_check('ForumTopicVote', $topic)->message() }}
        @else
            <button class="btn-osu-lite btn-osu-lite--default js-checkbox-validation--submit">
                {{ trans('forum.topics.show.poll.vote') }}
            </button>
        @endif
    </div>
{!! Form::close() !!}
