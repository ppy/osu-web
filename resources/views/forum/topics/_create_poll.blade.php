{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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
<div
    class="simple-form js-form-toggle--form"
    {{-- inlined style to work with jquery's slide animation --}}
    style="display: none;"
    data-form-toggle-id="poll-create"
>
    <h2 class="simple-form__row simple-form__row--title">
        {{ trans('forum.topics.create.create_poll') }}
    </h2>

    <label class="simple-form__row">
        <div class="simple-form__label">
            {{ trans('forum.topics.create.poll.title') }}
        </div>
        <input class="simple-form__input" name="forum_topic_poll[title]" />
    </label>

    <label class="simple-form__row">
        <div class="simple-form__label">
            {{ trans('forum.topics.create.poll.options') }}
            <p class="simple-form__info">{{ trans('forum.topics.create.poll.options_info') }}</p>
        </div>
        <textarea class="simple-form__input simple-form__input--full-height" name="forum_topic_poll[options]"></textarea>
    </label>

    <label class="simple-form__row simple-form__row--half">
        <div class="simple-form__label">
            {{ trans('forum.topics.create.poll.max_options') }}
            <p class="simple-form__info">{{ trans('forum.topics.create.poll.max_options_info') }}</p>
        </div>
        <input class="simple-form__input simple-form__input--small" name="forum_topic_poll[max_options]" />
    </label>

    <label class="simple-form__row simple-form__row--half">
        <div class="simple-form__label">
            {{ trans('forum.topics.create.poll.length') }}
            <p class="simple-form__info">{{ trans('forum.topics.create.poll.length_info') }}</p>
        </div>
        <div class="simple-form__input-group">
            <span class="simple-form__input-group-label simple-form__input-group-label--prefix">
                {{ trans('forum.topics.create.poll.length_days_prefix') }}
            </span>
            <input class="simple-form__input simple-form__input--small simple-form__input--centered" name="forum_topic_poll[length_days]" />
            <span class="simple-form__input-group-label simple-form__input-group-label--suffix">
                {{ trans('forum.topics.create.poll.length_days_suffix') }}
            </span>
        </div>
    </label>

    <label class="simple-form__row">
        <div class="simple-form__label simple-form__label--full">
            <div class="osu-checkbox">
                <input class="osu-checkbox__input" name="forum_topic_poll[vote_change]" type="checkbox" />
                <span class="osu-checkbox__box"></span>
                <span class="osu-checkbox__tick">
                    <i class="fa fa-check"></i>
                </span>
            </div>

            {{ trans('forum.topics.create.poll.vote_change') }}
            <span class="simple-form__info">{{ trans('forum.topics.create.poll.vote_change_info') }}</span>
        </div>
    </label>
</div>

<label class="btn-osu-lite btn-osu-lite--default">
    <div class="label-toggle">
        <input
            class="label-toggle__checkbox js-form-toggle--input"
            data-form-toggle-id="poll-create"
            name="with_poll"
            type="checkbox"
        />

        <span class="label-toggle__label label-toggle__label--uncheck">
            {{ trans('forum.topics.create.create_poll_button.remove') }}
        </span>

        <span class="label-toggle__label label-toggle__label--check">
            {{ trans('forum.topics.create.create_poll_button.add') }}
        </span>
    </div>
</label>
