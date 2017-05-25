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
@extends('master', ['titleAppend' => trans('news.index.title')])

@section('content')
    @include('news._header', ['title' => trans('news.index.title')])

    <div class="osu-page osu-page--generic">
        <div class="news-index">
            <div class="news-index__list">
                @foreach ($posts['posts'] as $post)
                    <div class="news-index-item">
                        <a
                            href="{{ route('news.show', $post->getKey()) }}"
                            class="news-index-item__title"
                        >{{ $post->title() }}</a>

                        <span class="news-index-item__time">
                            {!! trans('news.show.posted', ['time' => timeago($post->createdAt())]) !!}
                        </span>
                    </div>
                @endforeach
            </div>

            <div class="news-index__nav">
                @if (isset($posts['newerPosts']))
                    <a
                        class="news-index__nav-button news-index__nav-button--link"
                        href="{{ route('news.index', ['page' => $posts['newerPosts'], 'limit' => $limit]) }}"
                        title="{{ trans('news.index.nav.newer') }}"
                    >
                        <span class="fa fa-chevron-circle-left"></span>
                    </a>
                @else
                    <span
                        class="news-index__nav-button"
                        title="{{ trans('news.index.nav.newer') }}"
                    >
                        <span class="fa fa-chevron-circle-left"></span>
                    </span>
                @endif

                @if (isset($posts['olderPosts']))
                    <a
                        class="news-index__nav-button news-index__nav-button--link"
                        href="{{ route('news.index', ['page' => $posts['olderPosts'], 'limit' => $limit]) }}"
                        title="{{ trans('news.index.nav.older') }}"
                    >
                        <span class="fa fa-chevron-circle-right"></span>
                    </a>
                @else
                    <span
                        class="news-index__nav-button"
                        title="{{ trans('news.index.nav.older') }}"
                    >
                        <span class="fa fa-chevron-circle-right"></span>
                    </span>
                @endif
            </div>
        </div>
    </div>
@endsection
