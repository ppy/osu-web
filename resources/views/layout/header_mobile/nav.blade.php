{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@foreach (nav_links_mobile() as $section => $links)
    <li class="navbar-mobile-item dropdown">
        <a
            data-toggle="dropdown"
            class="navbar-mobile-item__main dropdown-toggle"
            href="{{ $links['_'] ?? array_values($links)[0] }}"
        >
            <span class="navbar-mobile-item__icon navbar-mobile-item__icon--main navbar-mobile-item__icon--closed">
                <i class="fas fa-chevron-right"></i>
            </span>

            <span class="navbar-mobile-item__icon navbar-mobile-item__icon--main navbar-mobile-item__icon--opened">
                <i class="fas fa-chevron-down"></i>
            </span>

            {{ trans("layout.menu.{$section}._") }}
        </a>

        <ul class="dropdown-menu" role="menu" aria-labelledby="expand-{{ $section }}">
            @foreach ($links as $action => $link)
                @if ($action === '_')
                    @continue
                @endif
                <li>
                    <a
                        class="navbar-mobile-item__submenu"
                        href="{{ $link }}"
                        data-toggle="collapse"
                        data-target=".js-navbar-mobile--menu"
                    >
                        <span class="navbar-mobile-item__icon">
                            <i class="fas fa-chevron-right"></i>
                        </span>

                        {{ trans("layout.menu.$section.$action") }}
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
@endforeach
