{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

@php
    $title = $titles[app()->getLocale().'/'.$section] ?? $titles[config('app.fallback_locale').'/'.$section] ?? null;
@endphp

<li class="osu-md__list-item">
    @if (isset($title))
        <a class="osu-md__link" href="{{ route('wiki.show', ['page' => $section]) }}">{{ $title }}</a>
    @else
        {{ $section }}
    @endif

    @if (is_array($sitemap))
        <ul class="osu-md__list">
            @foreach ($sitemap as $key => $value)
                @include('wiki._sitemap_section', ['section' => "{$section}/{$key}", 'sitemap' => $value, 'titles' => $titles])
            @endforeach
        </ul>
    @endif
</li>
