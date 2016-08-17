{{--
    Copyright 2015-2016 ppy Pty. Ltd.

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
    class="nav-popup nav-popup--sections js-current-user-cover"
>
    <div class="nav-popup__overlay"></div>
    <div class="nav-popup__section nav-popup__section--blank"></div>
    <div class="nav-popup__section nav-popup__section--user nav-popup__section--user-overview">
        <div class="nav-popup__row nav-popup__row--username">
            {{ $_user->username }}
        </div>

        <div class="nav-popup__row nav-popup__row--with-gutter">
            @if ($_user->country !== null)
                <img
                    class="nav-popup__flag"
                    src="/images/flags/{{ $_user->country_acronym }}.png"
                    title="{{ $_user->country->name }}"
                />
            @endif
        </div>
    </div>

    <div class="nav-popup__section nav-popup__section--user nav-popup__section--user-links">
        <a
            class="nav-popup__link"
            href="{{ route('users.show', $_user) }}"
        >
            <div class="nav-popup__link-marker">
                <i class="fa fa-angle-right"></i>
            </div>

            {{ trans('layout.popup_user.links.profile') }}
        </a>

        <a
            class="nav-popup__link"
            href="{{ route('home.account') }}"
        >
            <div class="nav-popup__link-marker">
                <i class="fa fa-angle-right"></i>
            </div>

            {{ trans('layout.popup_user.links.account') }}
        </a>

        <a
            class="js-logout-link nav-popup__link"
            href="{{ route('users.logout') }}"
            data-confirm="{{ trans('users.logout_confirm') }}"
            data-method="delete"
            data-remote="1"
        >
            <div class="nav-popup__link-marker">
                <i class="fa fa-angle-right"></i>
            </div>

            {{ trans('layout.popup_user.links.logout') }}
        </a>
    </div>

    <div class="nav-popup__bar">
        <span class="bar u-section-bg"></span>
    </div>
</div>
