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
@php
    $backgroundExtraClass = $params['backgroundExtraClass'] ?? '';
    $backgroundImage = $params['backgroundImage'] ?? null;
    $links = $params['links'] ?? null;
    $linksBreadcrumb = $params['linksBreadcrumb'] ?? false;
    $section = $params['section'] ?? null;
    $subSection = $params['subSection'] ?? null;
    $theme = $params['theme'] ?? null;

    $linksElement = $linksBreadcrumb ? 'ol' : 'ul';
@endphp
<div class="header-v4 {{ isset($theme) ? "header-v4--{$theme}" : '' }}">
    <div class="header-v4__bg-container">
        <div class="header-v4__bg {{ $backgroundExtraClass }}" {!! background_image($backgroundImage ?? null, false) !!}></div>
    </div>

    <div class="header-v4__content">
        <div class="header-v4__row header-v4__row--title">
            <div class="header-v4__icon"></div>
            <div class="header-v4__title">
                <span class="header-v4__title-section">
                    {{ $section }}
                </span>
                <span class="header-v4__title-action">
                    {{ $subSection }}
                </span>
            </div>
        </div>

        @if ($links !== null && count($links) > 0)
            <div class="header-v4__row header-v4__row--bar">
                <{!! $linksElement !!}
                    class="header-nav-v4 header-nav-v4--{{ $linksBreadcrumb ? 'breadcrumb' : 'list' }}"
                >
                    @foreach ($links as $link)
                        <li class="header-nav-v4__item">
                            <a
                                class="
                                    header-nav-v4__link
                                    {{ ($link['active'] ?? false) ? 'header-nav-v4__link--active' : '' }}
                                "
                                href="{{ $link['url'] }}"
                            >
                                {{ $link['title'] }}
                            </a>
                        </li>
                    @endforeach
                </{!! $linksElement !!}>
            </div>
        @endif
    </div>
</div>
