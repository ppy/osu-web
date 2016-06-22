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
]) !!}
    <ul>
        @foreach ($topic->pollOptions as $pollOption)
            <li>
                <label>
                    @if (priv_check('ForumTopicVote', $topic)->can())
                        <input
                            type="{{ $topic->poll_max_options == 1 ? 'radio' : 'checkbox' }}"
                            value="{{ $pollOption->poll_option_id }}"
                            name="forum_topic_vote[option_ids][]"
                            {{ $pollOption->userHasVoted(Auth::user()) ? 'checked' : '' }}
                        >
                    @endif

                    {{ $pollOption->poll_option_text }}
                    [{{ $pollOption->poll_option_total }}]
                </label>
            </li>
        @endforeach

        @if (!priv_check('ForumTopicVote', $topic)->can())
            {{ priv_check('ForumTopicVote', $topic)->message() }}
        @else
            <button>
                {{ trans('forum.topics.show.poll.vote') }}
            </button>
        @endif
    </ul>
{!! Form::close() !!}
