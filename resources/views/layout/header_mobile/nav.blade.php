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
            @foreach ($links as $action => $link)
                @if ($action === '_')
                    @continue
                @endif
                <li>
                    <a
                        class="navbar-mobile-item__submenu-item js-click-menu--close"
                        href="{{ $link }}"
                    >
                        {{ osu_trans("layout.menu.$section.$action") }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endforeach

<div class="navbar-mobile-item">
    <button
        class="navbar-mobile-item__main js-click-menu"
        data-click-menu-target="nav-mobile-locale"
    >
        <span class="navbar-mobile-item__icon navbar-mobile-item__icon--closed">
            <i class="fas fa-chevron-right"></i>
        </span>

        <span class="navbar-mobile-item__icon navbar-mobile-item__icon--opened">
            <i class="fas fa-chevron-down"></i>
        </span>

        <span class="navbar-mobile-item__locale-flag">
            @include('objects._flag_country', [
                'countryCode' => $currentLocaleMeta->flag(),
                'modifiers' => ['small', 'flat'],
            ])
        </span>

        {{ $currentLocaleMeta->name() }}
    </button>

    <ul class="navbar-mobile-item__submenu js-click-menu" data-click-menu-id="nav-mobile-locale">
        @foreach (config('app.available_locales') as $locale)
            @php
                $localeMeta = locale_meta($locale);
            @endphp
            <li>
                <a
                    class="navbar-mobile-item__submenu-item js-click-menu--close"
                    href="{{ route('set-locale', compact('locale')) }}"
                    data-remote="1"
                    data-method="POST"
                >
                    <span class="navbar-mobile-item__locale-flag">
                        @include('objects._flag_country', [
                            'countryCode' => $localeMeta->flag(),
                            'modifiers' => ['small', 'flat'],
                        ])
                    </span>

                    {{ $localeMeta->name() }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
