{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{{-- just in case php has shorttag enabled --}}
{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<feed xml:lang="en-US" xmlns="http://www.w3.org/2005/Atom">
    <id>{{ atom_id('news') }}</id>

    <link rel="alternate" type="text/html" href="{{ route('news.index') }}" />
    <link rel="self" type="application/atom+xml" href="{{ request()->fullUrl() }}" />

    <title>osu!news</title>
    <icon>{{ config('app.url') }}/apple-touch-icon.png</icon>

    <updated>{{ json_time(optional($posts->last())->published_at ?? now()) }}</updated>

    @foreach ($posts as $post)
        <entry>
            <id>{{ atom_id('news', $post->getKey()) }}</id>
            <published>{{ json_time($post->published_at) }}</published>
            {{-- TODO: atom:updated is required but we don't have one (yet?) so this will do for now --}}
            <updated>{{ json_time($post->published_at) }}</updated>
            <link rel="alternate" type="text/html" href="{{ route('news.show', $post->slug) }}" />
            <title>{{ $post->title() }}</title>
            <content type="html">
                {{ $post->bodyHtml() }}
            </content>

            <author>
                <name>osu!team</name>
            </author>
        </entry>
    @endforeach
</feed>
