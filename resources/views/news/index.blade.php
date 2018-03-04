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
@extends('master', ['title' => trans('news.index.title')])

@section('content')
    @component('news._header', ['title' => trans('news.index.title')])
        @slot('actions')
            <div class="forum-post-actions">
                @if (priv_check('NewsIndexUpdate')->can())
                    <div class="forum-post-actions__action">
                        <button
                            type="button"
                            class="btn-circle"
                            data-remote="true"
                            data-url="{{ route('news.store') }}"
                            data-method="POST"
                            data-reload-on-success="1"
                            title="{{ trans('news.store.button') }}"
                            data-tooltip-position="left center"
                        >
                            <span class="btn-circle__content">
                                <i class="fa fa-refresh"></i>
                            </span>
                        </button>
                    </div>
                @endif
            </div>
        @endslot
    @endcomponent

    <div class="osu-page osu-page--generic">
        <div class="news-index">
            <div class="news-index__list">
                @foreach ($posts as $post)
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

            <div class="t-forum-category-osu">
                @include('forum._pagination', ['object' => $posts
                    ->appends([
                        'limit' => Request::input('limit'),
                    ])
                ])
            </div>
        </div>
    </div>
@endsection
