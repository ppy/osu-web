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
    <a
        class="news-post-preview__image"
        href='{{ route('news.show', $post->getKey() )}}'
        {!! background_image($post->firstImage()) !!}
    ></a>
    <div class="news-post-preview__body">
        <div class="news-post-preview__post-date">
            <div class="news-post-preview__date">
                {{$post->createdAt()->formatLocalized('%d')}}
            </div>
            <div class="news-post-preview__month-year">
                @if ($collapsed)
                    &nbsp;{{$post->createdAt()->formatLocalized('%b')}}
                @else
                    {{$post->createdAt()->formatLocalized('%b %Y')}}
                @endif
            </div>
        </div>
        <div class="news-post-preview__post-right">
            <a href='{{ route('news.show', $post->getKey()) }}' class='news-post-preview__post-title'>
                {{ $post->title() }}
            </a>
            <div class="news-post-preview__post-content">
                <p>{!! $post->previewText() !!}</p>
            </div>
        </div>
    </div>
</div>
