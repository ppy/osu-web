{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
