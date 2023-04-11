{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $publishedAt = $post->published_at;
@endphp
<div class="news-post-preview{{$collapsed ? ' news-post-preview--collapsed' : ''}}">
    <a
        class="news-post-preview__image"
        href='{{ route('news.show', $post->slug) }}'
        {!! background_image($post->firstImage()) !!}
    ></a>
    <div class="news-post-preview__body">
        <div class="news-post-preview__post-date js-tooltip-time" title="{{ json_time($publishedAt) }}">
            <div class="news-post-preview__date">
                {{ i18n_date_auto($publishedAt, 'd') }}
            </div>

            <div class="news-post-preview__month-year">
                @if ($collapsed)
                    &nbsp;{{ i18n_date_auto($publishedAt, 'MMM') }}
                @else
                    {{ i18n_date_auto($publishedAt, 'yMMM') }}
                @endif
            </div>
        </div>
        <div class="news-post-preview__post-right">
            <a href='{{ route('news.show', $post->slug) }}' class='news-post-preview__post-title'>
                {{ $post->title() }}
            </a>
            <div class="news-post-preview__post-content">
                <p>{!! $post->previewText() !!}</p>
            </div>
        </div>
    </div>
</div>
