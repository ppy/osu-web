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
{{-- just in case php has shorttag enabled --}}
{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>osu!news</title>
        <link>{{ route('news.index') }}</link>
        <atom:link rel="self" type="application/rss+xml" href="{{ request()->fullUrl() }}" />
        <description>Latest news on osu!</description>

        @foreach ($posts as $post)
            <item>
                <title>{{ $post->title() }}</title>
                <link>{{ route('news.show', $post->slug) }}</link>
                <guid isPermaLink="false">{{ atom_id('news', $post->getKey()) }}</guid>
                <pubDate>{{ $post->published_at->toRfc7231String() }}</pubDate>
                <description>{{ $post->bodyHtml() }}</description>
            </item>
        @endforeach
    </channel>
</rss>
