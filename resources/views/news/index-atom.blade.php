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
<feed xml:lang="en-US" xmlns="http://www.w3.org/2005/Atom">
    <id>{{ atom_id('news') }}</id>

    <link rel="alternate" type="text/html" href="{{ route('news.index') }}" />
    <link rel="self" type="application/atom+xml" href="{{ request()->fullUrl() }}" />

    <title>osu!news</title>
    <icon>{{ config('osu.static') }}/apple-touch-icon.png</icon>

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
