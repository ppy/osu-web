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

<a href="{{$href}}" class='btn-osu-big btn-osu-big--user-homepage {{$colour}}'>
    <div class='btn-osu-big__content' style="flex-direction: column;">
        <div class='btn-osu-big__left' style='align-items: center;'>
            <span class='btn-osu-big__text-top' style='margin-bottom: 5px;'>{{$label}}</span>
            <div class='btn-osu-big__icon' style='margin-left: 0px; font-size: 100%;'>
                <i class='fa fa-fw fa-{{$icon}}'></i>
            </div>
        </div>
    </div>
</a>
