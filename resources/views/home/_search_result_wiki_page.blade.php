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
        $source = $entry->getSource();
        $url = wiki_url($entry->path, $entry->locale);
    @endphp
    <div class="search-result-entry">
        <a
            class="search-entry"
            href="{{ $url }}"
        >
            <h1 class="search-entry__row search-entry__row--title">
                <span class="search-highlight">
                    {!! $entry->highlightedTitle() !!}
                </span>

            </h1>

            <p class="search-entry__row search-entry__row--excerpt">
                <span class="search-highlight">
                    {!! $entry->highlights() !!}
                </span>
            </p>

            <p class="search-entry__row search-entry__row--footer">
                {{ $url }}
            </p>
        </a>
    </div>
@endforeach
