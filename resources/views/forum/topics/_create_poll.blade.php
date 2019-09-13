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
    $topic = $topic ?? null;
    $options = optional($topic)->pollOptions ?? collect();
@endphp
<div class="simple-form">
    <label class="simple-form__row">
        <div class="simple-form__label">
            {{ trans('forum.topics.create.poll.title') }}
        </div>
        <input
            class="simple-form__input"
            name="forum_topic_poll[title]"
            value="{{ optional($topic)->pollTitleRaw() }}"
        />
    </label>

    <label class="simple-form__row">
        <div class="simple-form__label">
            {{ trans('forum.topics.create.poll.options') }}
            <p class="simple-form__info">{{ trans('forum.topics.create.poll.options_info') }}</p>
        </div>
        <textarea
            class="simple-form__input simple-form__input--full-height"
            name="forum_topic_poll[options]"
            rows="10"
        >{{ $options->map->optionTextRaw()->implode("\n") }}</textarea>
    </label>

    <label class="simple-form__row simple-form__row--half">
        <div class="simple-form__label">
            {{ trans('forum.topics.create.poll.max_options') }}
            <p class="simple-form__info">{{ trans('forum.topics.create.poll.max_options_info') }}</p>
        </div>
        <input
            class="simple-form__input simple-form__input--small"
            name="forum_topic_poll[max_options]"
            value="{{ optional($topic)->poll_max_options }}"
        />
    </label>

    <label class="simple-form__row simple-form__row--half">
        <div class="simple-form__label">
            {{ trans('forum.topics.create.poll.length') }}
            <p class="simple-form__info">{{ trans('forum.topics.create.poll.length_info') }}</p>
        </div>
        <div class="simple-form__input-group">
            <input
                class="simple-form__input simple-form__input--small simple-form__input--centered"
                name="forum_topic_poll[length_days]"
                value="{{ optional($topic)->poll_length > 0 ? $topic->poll_length_days : '' }}"
            />
            <span class="simple-form__input-group-label simple-form__input-group-label--suffix">
                {{ trans('forum.topics.create.poll.length_days_suffix') }}
            </span>
        </div>
    </label>

    <label class="simple-form__row">
        <div class="simple-form__label simple-form__label--full">
            @include('objects._switch', [
                'checked' => optional($topic)->poll_vote_change,
                'name' => 'forum_topic_poll[vote_change]',
            ])

            {{ trans('forum.topics.create.poll.vote_change') }}
            <span class="simple-form__info">{{ trans('forum.topics.create.poll.vote_change_info') }}</span>
        </div>
    </label>

    <label class="simple-form__row">
        <div class="simple-form__label simple-form__label--full">
            @include('objects._switch', [
                'checked' => optional($topic)->poll_hide_results,
                'name' => 'forum_topic_poll[hide_results]',
            ])

            {{ trans('forum.topics.create.poll.hide_results') }}
            <span class="simple-form__info">{{ trans('forum.topics.create.poll.hide_results_info') }}</span>
        </div>
    </label>
</div>
