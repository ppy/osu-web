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
    $page = is_array($sitemap) ? $parent : $sitemap;
    $title = $titles[app()->getLocale().'/'.$page] ?? $titles[config('app.fallback_locale').'/'.$page] ?? null;
@endphp

<li class="osu-md__list-item">
    @if (isset($title))
        <a class="osu-md__link" href="{{ route('wiki.show', compact('page')) }}">{{ $title }}</a>
    @else
        {{ $page }}
    @endif

    @if (is_array($sitemap))
        <ul class="osu-md__list">
            @foreach ($sitemap as $key => $value)
                @include('wiki._sitemap_section', ['parent' => "{$parent}/{$key}", 'sitemap' => $value, 'titles' => $titles])
            @endforeach
        </ul>
    @endif
</li>
