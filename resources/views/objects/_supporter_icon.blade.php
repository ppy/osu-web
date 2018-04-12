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

{{-- see also supporter-icon.coffee for react component --}}
<span class="supporter-icon{{isset($smaller) && $smaller === true ? ' supporter-icon--smaller' : ''}} fa-stack" title="{{ trans('users.show.is_supporter') }}">
    @if (isset($background) && $background === true) <i class="supporter-icon__bg fas fa-circle fa-stack-2x"></i> @endif
    <i class="far fa-circle fa-stack-2x"></i>
    <i class="supporter-icon__heart fas fa-heart fa-stack-1x"></i>
</span>
