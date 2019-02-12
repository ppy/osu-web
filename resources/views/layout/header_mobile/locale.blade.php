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
<li class="navbar-mobile-item dropdown">
    <a
        data-toggle="dropdown"
        class="navbar-mobile-item__main dropdown-toggle"
        href="#"
    >
        <span class="navbar-mobile-item__icon navbar-mobile-item__icon--main navbar-mobile-item__icon--closed">
            <i class="fas fa-chevron-right"></i>
        </span>

        <span class="navbar-mobile-item__icon navbar-mobile-item__icon--main navbar-mobile-item__icon--opened">
            <i class="fas fa-chevron-down"></i>
        </span>

        <span
            class="navbar-mobile-item__locale-flag"
            style="background-image: url('{{ flag_path(locale_flag(App::getLocale())) }}')"
        ></span>

        {{ locale_name(App::getLocale()) }}
    </a>

    <ul class="dropdown-menu">
        @foreach (config('app.available_locales') as $locale)
            <li>
                <a
                    class="navbar-mobile-item__submenu"
                    href="{{ route('set-locale', compact('locale')) }}"
                    data-remote="1"
                    data-method="POST"
                    data-toggle="collapse"
                    data-target=".js-navbar-mobile--menu"
                >
                    <span class="navbar-mobile-item__icon">
                        <i class="fas fa-chevron-right"></i>
                    </span>

                    <span
                        class="navbar-mobile-item__locale-flag"
                        style="background-image: url('{{ flag_path(locale_flag($locale)) }}')"
                    ></span>

                    {{ locale_name($locale) }}
                </a>
            </li>
        @endforeach
    </ul>
</li>
