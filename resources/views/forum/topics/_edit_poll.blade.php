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
    'url' => route('forum.topics.edit-poll', $topic),
    'data-remote' => true,
    'class' => 'js-forum-poll-edit-save'
]) !!}
    <div class="forum-poll__warning">
        {{ trans('forum.poll.edit_warning') }}
    </div>

    @include('forum.topics._create_poll', ['edit' => true])

    <div class="forum-poll__row">
        <button
            class="btn-osu-lite btn-osu-lite--default js-forum-poll-edit-cancel"
            type="button"
        >
            {{ trans('common.buttons.cancel') }}
        </button>

        <button
            class="btn-osu-lite btn-osu-lite--default"
            type="submit"
            data-disable-with="{{ trans('common.buttons.saving') }}"
        >
            {{ trans('common.buttons.save') }}
        </button>
    </div>
{!! Form::close() !!}
