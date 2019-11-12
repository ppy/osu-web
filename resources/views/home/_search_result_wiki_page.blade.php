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
@foreach ($search->data() as $entry)
    @php
        $url = wiki_url($entry->path, $entry->locale);
    @endphp
    <div class="search-result-entry">
        <a
            class="search-entry"
            href="{{ $url }}"
        >
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
    </div>
@endforeach
