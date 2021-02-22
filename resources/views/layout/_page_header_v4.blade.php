{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $backgroundExtraClass = $params['backgroundExtraClass'] ?? '';
    $backgroundImage = $params['backgroundImage'] ?? null;
    $currentActive = $params['currentActive'] ?? null;
    $headerExtraClass = $params['headerExtraClass'] ?? '';
    $links = $params['links'] ?? null;
    $linksBreadcrumb = $params['linksBreadcrumb'] ?? false;
    $theme = $params['theme'] ?? null;
    $showTitle = $params['showTitle'] ?? true;
    $currentUser = auth()->user();

    $linksElement = $linksBreadcrumb ? 'ol' : 'ul';
@endphp
<div class="
    header-v4
    @if ($theme !== null)
        header-v4--{{ $theme }}
    @endif
    @if ($currentUser !== null && ($currentUser->isRestricted() || ($currentActive === 'account_controller.edit' && $currentUser->isSilenced())))
        header-v4--restricted
    @endif
    {{ $headerExtraClass }}
">
    <div class="header-v4__container header-v4__container--main">
        <div class="header-v4__bg-container">
            <div class="header-v4__bg {{ $backgroundExtraClass }}" {!! background_image($backgroundImage ?? null, false) !!}></div>
        </div>

        <div class="header-v4__content">
            @if ($showTitle || isset($titleAppend))
                <div class="header-v4__row header-v4__row--title">
                    @if ($showTitle)
                        <div class="header-v4__icon"></div>
                        <div class="header-v4__title">
                            {{ page_title() }}
                        </div>
                    @endif

                    {{ $titleAppend ?? null }}
                </div>
            @endif

            {{ $contentAppend ?? null }}
        </div>
    </div>
    @if ($links !== null && count($links) > 0)
        <div class="header-v4__container">
            <div class="header-v4__content">
                <div class="header-v4__row header-v4__row--bar">
                    <{!! $linksElement !!}
                        class="header-nav-v4 header-nav-v4--{{ $linksBreadcrumb ? 'breadcrumb' : 'list' }}"
                    >
                        @foreach ($links as $link)
                            @php
                                $active = $link['active'] ?? false;

                                // also used for mobile nav later
                                if ($active) {
                                    $activeLink = $link;
                                }
                            @endphp
                            <li class="header-nav-v4__item">
                                @if (isset($link['url']))
                                    <a
                                        class="
                                            header-nav-v4__link
                                            {{ $active ? 'header-nav-v4__link--active' : '' }}
                                        "
                                        href="{{ $link['url'] }}"
                                    >
                                        <span
                                            class="fake-bold"
                                            data-content={{ $link['title'] }}
                                        >{{ $link['title'] }}</span>
                                    </a>
                                @else
                                    <span class="header-nav-v4__text">{{ $link['title'] }}</span>
                                @endif
                            </li>
                        @endforeach
                    </{!! $linksElement !!}>

                    @if (!$linksBreadcrumb)
                        <div class="header-nav-mobile">
                            <a
                                class="header-nav-mobile__toggle js-click-menu"
                                data-click-menu-target="header-nav-mobile"
                                href="{{ $activeLink['url'] }}"
                            >
                                {{ $activeLink['title'] }}

                                <span class="header-nav-mobile__toggle-icon">
                                    <span class="fas fa-chevron-down"></span>
                                </span>
                            </a>

                            <ul
                                class="header-nav-mobile__menu js-click-menu"
                                data-click-menu-id="header-nav-mobile"
                                data-visibility="hidden"
                            >
                                @foreach ($links as $link)
                                    <li>
                                        <a
                                            class="header-nav-mobile__item"
                                            href="{{ $link['url'] }}"
                                        >
                                            {{ $link['title'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{ $navAppend ?? null }}
                </div>
            </div>
        </div>
    @endif
</div>
