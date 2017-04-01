{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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

<div class="news-post-preview{{$collapsed ? ' news-post-preview--collapsed' : ''}}">
    @php
        $post_image = find_first_image($post->body);
        $post_image_tag = presence($post_image) ? ' style="background-image: url('.proxy_image($post_image).');"' : null;
    @endphp
    <a class="news-post-preview__image"{!!$post_image_tag!!} href='{{route('news.show', $post->id)}}'></a>
    <div class="news-post-preview__body">
        <div class="news-post-preview__post-date">
            <div class="news-post-preview__date">
                {{Carbon\Carbon::parse($post->date)->formatLocalized('%d')}}
            </div>
            <div class="news-post-preview__month-year">
                @if ($collapsed)
                    {{Carbon\Carbon::parse($post->date)->formatLocalized('&nbsp;%b')}}
                @else
                    {{Carbon\Carbon::parse($post->date)->formatLocalized('%b %Y')}}
                @endif
            </div>
        </div>
        <div class="news-post-preview__post-right">
            <a href='{{route('news.show', $post->id)}}' class='news-post-preview__post-title'>
                {{$post->title}}
            </a>
            <div class="news-post-preview__post-content">
                <p>{!! first_paragraph($post->body) !!}</p>
            </div>
        </div>
    </div>
</div>
