{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if (is_array($sitemap))
    <ul class="osu-md__list">
        @foreach ($sitemap as $childSection => $childSitemap)
            @php
                $currentSection = concat_path([$section ?? null, $childSection]);
                $title = $titles["{$locale}/{$currentSection}"]
                    ?? $titles[config('app.fallback_locale').'/'.$currentSection]
                    ?? null;
            @endphp

            <li class="osu-md__list-item">
                @if (isset($title))
                    <a class="osu-md__link" href="{{ wiki_url($currentSection, $locale) }}">{{ $title }}</a>
                @else
                    {{ $currentSection }}
                @endif

                @include('wiki._sitemap_section', [
                    'section' => $currentSection,
                    'sitemap' => $childSitemap,
                    'titles' => $titles
                ])
            </li>
        @endforeach
    </ul>
@endif
