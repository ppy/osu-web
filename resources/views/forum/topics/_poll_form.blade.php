{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
                    @include('objects._switch', ['locals' => [
                        'checked' => $pollOption['voted_by_user'],
                        'name' => 'forum_topic_vote[option_ids][]',
                        'type' => $topic->poll_max_options === 1 ? 'radio' : 'checkbox',
                        'value' => $pollOptionId,
                    ]])
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
                        {{ osu_trans('forum.topics.show.poll.vote') }}
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
                        {{ osu_trans('forum.topics.show.poll.button.view_results') }}
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
{!! Form::close() !!}
