{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $topic = $topic ?? null;
    $options = optional($topic)->pollOptions ?? collect();
@endphp
<div class="simple-form">
    <label class="simple-form__row">
        <div class="simple-form__label">
            {{ osu_trans('forum.topics.create.poll.title') }}
        </div>
        <input
            class="simple-form__input"
            name="forum_topic_poll[title]"
            value="{{ optional($topic)->pollTitleRaw() }}"
        />
    </label>

    <label class="simple-form__row">
        <div class="simple-form__label">
            {{ osu_trans('forum.topics.create.poll.options') }}
            <p class="simple-form__info">{{ osu_trans('forum.topics.create.poll.options_info') }}</p>
        </div>
        <textarea
            class="simple-form__input simple-form__input--full-height"
            name="forum_topic_poll[options]"
            rows="10"
        >{{ $options->map->optionTextRaw()->implode("\n") }}</textarea>
    </label>

    <label class="simple-form__row simple-form__row--half">
        <div class="simple-form__label">
            {{ osu_trans('forum.topics.create.poll.max_options') }}
            <p class="simple-form__info">{{ osu_trans('forum.topics.create.poll.max_options_info') }}</p>
        </div>
        <input
            class="simple-form__input simple-form__input--small"
            name="forum_topic_poll[max_options]"
            value="{{ optional($topic)->poll_max_options }}"
        />
    </label>

    <label class="simple-form__row simple-form__row--half">
        <div class="simple-form__label">
            {{ osu_trans('forum.topics.create.poll.length') }}
            <p class="simple-form__info">{{ osu_trans('forum.topics.create.poll.length_info') }}</p>
        </div>
        <div class="simple-form__input-group">
            <input
                class="simple-form__input simple-form__input--small simple-form__input--centered"
                name="forum_topic_poll[length_days]"
                value="{{ optional($topic)->poll_length > 0 ? $topic->poll_length_days : '' }}"
            />
            <span class="simple-form__input-group-label simple-form__input-group-label--suffix">
                {{ osu_trans('forum.topics.create.poll.length_days_suffix') }}
            </span>
        </div>
    </label>

    <label class="simple-form__row">
        <div class="simple-form__label simple-form__label--full">
            @include('objects._switch', ['locals' => [
                'checked' => $topic?->poll_vote_change,
                'name' => 'forum_topic_poll[vote_change]',
            ]])

            {{ osu_trans('forum.topics.create.poll.vote_change') }}
            <span class="simple-form__info">{{ osu_trans('forum.topics.create.poll.vote_change_info') }}</span>
        </div>
    </label>

    <label class="simple-form__row">
        <div class="simple-form__label simple-form__label--full">
            @include('objects._switch', ['locals' => [
                'checked' => $topic?->poll_hide_results,
                'name' => 'forum_topic_poll[hide_results]',
            ]])

            {{ osu_trans('forum.topics.create.poll.hide_results') }}
            <span class="simple-form__info">{{ osu_trans('forum.topics.create.poll.hide_results_info') }}</span>
        </div>
    </label>
</div>
