{{--
    Copyright 2015-2018 ppy Pty. Ltd.

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
]) !!}
    @include('forum.topics._create_poll')

    <button
        class="btn-osu-lite btn-osu-lite--default js-forum-poll-edit-cancel"
        type="button"
    >
        Cancel
    </button>

    <button
        class="btn-osu-lite btn-osu-lite--default"
        type="submit"
        data-disable-with="{{ trans('common.buttons.saving') }}"
    >
        Update
    </button>
{!! Form::close() !!}
