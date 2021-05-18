{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="nav2 js-nav-button">
    <div class="nav2__colgroup nav2__colgroup--menu js-nav-button--container">
        <div class="nav2__col nav2__col--logo">
            <a href="{{ route('home') }}" class="nav2__logo-link">
                <div class="nav2__logo nav2__logo--bg"></div>
                <div class="nav2__logo"></div>
            </a>
        </div>

        @foreach (nav_links() as $section => $links)
            <div class="nav2__col nav2__col--menu">
                <a
                    class="nav2__menu-link-main js-menu"
                    href="{{ $links['_'] ?? array_first($links) }}"
                    data-menu-target="nav2-menu-popup-{{ $section }}"
                    data-menu-show-delay="0"
                >
                    <span class="u-relative">
                        {{ trans("layout.menu.{$section}._") }}

                        @if ($section === $currentSection && !($isSearchPage ?? false))
                            <span class="nav2__menu-link-bar u-section--bg-normal"></span>
                        @endif
                    </span>
                </a>

                <div class="nav2__menu-popup">
                    <div
                        class="
                            simple-menu
                            simple-menu--nav2
                            simple-menu--nav2-left-aligned
                            simple-menu--nav2-transparent
                            js-menu
                        "
                        data-menu-id="nav2-menu-popup-{{ $section }}"
                        data-visibility="hidden"
                    >
                        @foreach ($links as $action => $link)
                            @if ($action === '_')
                                @continue
                            @endif
                            <a class="simple-menu__item u-section-{{ $section }}--before-bg-normal" href="{{ $link }}">
                                {{ trans("layout.menu.{$section}.{$action}") }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach

        <div class="nav2__col nav2__col--menu js-react--quick-search-button">
            <a
                href="{{ route('search') }}"
                class="
                    nav2__menu-link-main
                    nav2__menu-link-main--search
                    {{ isset($isSearchPage) ? 'u-section--bg-normal' : '' }}
                "
            >
                <span class="fas fa-search"></span>
            </a>
        </div>
    </div>
    <div class="nav2__colgroup js-nav-button--container">
        <div class="nav2__col js-nav-button--item">
            <a
                href="{{ osu_url('social.twitter') }}"
                class="nav-button nav-button--social"
                title="Twitter"
            >
                <span class="fab fa-twitter"></span>
            </a>
        </div>

        <div class="nav2__col">
            <a
                href="{{ route('support-the-game') }}"
                class="nav-button nav-button--support"
                title="{{ trans('page_title.main.home_controller.support_the_game') }}"
            >
                <span class="fas fa-heart"></span>
            </a>
        </div>

        <div class="nav2__col">
            <button
                class="nav-button nav-button--stadium js-click-menu"
                data-click-menu-target="nav2-locale-popup"
            >
                <span class="nav-button__locale-current-flag">
                    @include('objects._flag_country', [
                        'countryCode' => locale_flag(App::getLocale()),
                        'modifiers' => ['flat'],
                    ])
                </span>
            </button>

            <div class="nav-click-popup">
                <div
                    class="simple-menu simple-menu--nav2 simple-menu--nav2-locales js-click-menu js-nav2--centered-popup"
                    data-click-menu-id="nav2-locale-popup"
                    data-visibility="hidden"
                >
                    <div class="simple-menu__content">
                        @foreach (config('app.available_locales') as $locale)
                            <button
                                type="button"
                                class="
                                    simple-menu__item
                                    {{ $locale === App::getLocale() ? 'simple-menu__item--active' : '' }}
                                "
                                @if ($locale !== App::getLocale())
                                    data-url="{{ route('set-locale', ['locale' => $locale]) }}"
                                    data-remote="1"
                                    data-method="POST"
                                @endif
                            >
                                <span class="nav2-locale-item">
                                    <span class="nav2-locale-item__flag">
                                        @include('objects._flag_country', [
                                            'countryCode' => locale_flag($locale),
                                            'modifiers' => ['flat'],
                                        ])
                                    </span>

                                    {{ locale_name($locale) }}
                                </span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if (Auth::user() !== null)
            <div class="nav2__col">
                <button
                    class="nav-button nav-button--stadium js-click-menu js-react--chat-icon"
                    data-click-menu-target="nav2-chat-notification-widget"
                    data-turbolinks-permanent
                    id="notification-widget-chat-icon"
                >
                    <span class="notification-icon">
                        <i class="fas fa-comment-alt"></i>
                        <span class="notification-icon__count">...</span>
                    </span>
                </button>
                <div
                    class="nav-click-popup js-click-menu js-react--notification-widget"
                    data-click-menu-id="nav2-chat-notification-widget"
                    data-visibility="hidden"
                    data-notification-widget="{{ json_encode(['extraClasses' => 'js-nav2--centered-popup', 'only' => 'channel']) }}"
                    data-turbolinks-permanent
                    id="notification-widget-chat"
                ></div>

            </div>

            <div class="nav2__col">
                <button
                    class="nav-button nav-button--stadium js-click-menu js-react--main-notification-icon"
                    data-click-menu-target="nav2-notification-widget"
                    data-turbolinks-permanent
                    id="notification-widget-icon"
                >
                    <span class="notification-icon">
                        <i class="fas fa-inbox"></i>
                        <span class="notification-icon__count">...</span>
                    </span>
                </button>
                <div
                    class="nav-click-popup js-click-menu js-react--notification-widget"
                    data-click-menu-id="nav2-notification-widget"
                    data-visibility="hidden"
                    data-notification-widget="{{ json_encode(['extraClasses' => 'js-nav2--centered-popup', 'excludes' => ['channel']]) }}"
                    data-turbolinks-permanent
                    id="notification-widget"
                ></div>
            </div>
        @endif

        <div class="nav2__col nav2__col--avatar">
            @include('layout._header_user')

            <div class="nav-click-popup nav-click-popup--user js-user-header-popup">
                @if (Auth::user() !== null)
                    @include('layout._popup_user')
                @endif
            </div>
        </div>
    </div>
</div>
