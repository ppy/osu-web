{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@foreach ($navLinks as $section => $links)
    <div class="navbar-mobile-item">
        <a
            data-click-menu-target="nav-mobile-{{ $section }}"
            class="navbar-mobile-item__main js-click-menu"
            href="{{ $links['_'] ?? array_values($links)[0] }}"
        >
            <span class="navbar-mobile-item__icon navbar-mobile-item__icon--closed">
                <i class="fas fa-chevron-right"></i>
            </span>

            <span class="navbar-mobile-item__icon navbar-mobile-item__icon--opened">
                <i class="fas fa-chevron-down"></i>
            </span>

            {{ osu_trans("layout.menu.{$section}._") }}
        </a>

        <ul class="navbar-mobile-item__submenu js-click-menu" data-click-menu-id="nav-mobile-{{ $section }}">
            @foreach ($links as $transKey => $link)
                @if ($transKey === '_')
                    @continue
                @endif
                <li>
                    <a
                        class="navbar-mobile-item__submenu-item js-click-menu--close"
                        href="{{ $link }}"
                    >
                        {{ osu_trans($transKey) }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endforeach

{!! app('layout-cache')->getLocalesMobile() !!}
