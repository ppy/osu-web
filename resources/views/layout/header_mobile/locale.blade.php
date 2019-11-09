{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
