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
    'class' => 'js-checkbox-validation js-forum-poll forum-poll',
]) !!}
    <div class="forum-poll__row forum-poll__row--title">
        <h2 class="forum-poll__title">
            {!! $topic->pollTitleHTML() !!}
        </h2>
    </div>

    <div class="forum-poll__row forum-poll__row--options">
        @foreach ($pollSummary['options'] as $pollOptionId => $pollOption)
            <label class="forum-poll-option">
                <div class="forum-poll-option__input">
                    @include('objects._switch', [
                        'checked' => $pollOption['voted_by_user'],
                        'name' => 'forum_topic_vote[option_ids][]',
                        'type' => $topic->poll_max_options === 1 ? 'radio' : 'checkbox',
                        'value' => $pollOptionId,
                    ])
                </div>
                <div class="forum-poll-option__label">
                    {!! $pollOption['textHTML'] !!}
                </div>
            </label>
        @endforeach
    </div>

    @if (count($buttons) > 0)
        <div class="forum-poll__row forum-poll__row--buttons">
            @if ($buttons['vote'])
                <div class="forum-poll__button">
                    <button
                        class="js-checkbox-validation--submit btn-osu-big btn-osu-big--forum-primary"
                        disabled
                    >
                        {{ trans('forum.topics.show.poll.vote') }}
                    </button>
                </div>
            @endif

            @if ($buttons['viewResults'])
                <div class="forum-poll__button">
                    <button
                        class="js-forum-poll--switch-page btn-osu-big btn-osu-big--forum-secondary"
                        data-target-page="results"
                        type="button"
                    >
                        {{ trans('forum.topics.show.poll.button.view_results') }}
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
{!! Form::close() !!}
