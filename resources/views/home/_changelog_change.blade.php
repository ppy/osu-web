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

<div class="changelog-change">
    <div class="changelog-change__left">
        <span class="changelog-change__icon fa fa-{{ build_icon($log->prefix) }}" title={{ trans('changelog.prefixes.'.$log->prefix) }}></span>
        <a
            href="{{route('users.show', ['user' => $log->user_id])}}"
            class="changelog-change__username"
        >
            {{ $log->user->username }}
        </a>
    </div>
    <div class="changelog-change__right {{ $log->major === 1 ? 'changelog-change__right--major' : '' }}">
        @if(present($log->category) === true)
            {{ $log->category }}:
        @endif
        {{ $log->message }}
    </div>
</div>
