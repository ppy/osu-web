{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@foreach ($search->data() as $entry)
    @php
        $url = wiki_url($entry->path, $entry->locale);
    @endphp
    <a class="search-entry" href="{{ $url }}">
        <div class="search-wiki-page">
            <div class="search-wiki-page__content">
                <h1 class="search-wiki-page__row search-wiki-page__row--title">
                    <span class="search-highlight">
                        {!! $entry->highlightedTitle() !!}
                    </span>

                </h1>

                <p class="search-wiki-page__row search-wiki-page__row--excerpt">
                    <span class="search-highlight">
                        {!! $entry->highlights() !!}
                    </span>
                </p>

                <p class="search-wiki-page__row search-wiki-page__row--footer">
                    {{ $url }}
                </p>
            </div>
            <div class="search-wiki-page__more">
                <span class="fas fa-angle-right"></span>
            </div>
        </div>
    </a>
@endforeach
