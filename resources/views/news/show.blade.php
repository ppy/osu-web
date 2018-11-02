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
@extends('master', ['titlePrepend' => $post->title()])

@section('content')
    @component('news._header', ['title' => $post->title()])
        @slot('actions')
            <div class="forum-post-actions">
                @if (priv_check('NewsPostUpdate')->can())
                    <div class="forum-post-actions__action">
                        <a
                            class="btn-circle"
                            href="{{ $post->editUrl() }}"
                            title="{{ trans('wiki.show.edit.link') }}"
                            data-tooltip-position="left center"
                        >
                            <span class="btn-circle__content">
                                <i class="fab fa-github"></i>
                            </span>
                        </a>
                    </div>

                    <div class="forum-post-actions__action">
                        <button
                            type="button"
                            class="btn-circle"
                            data-remote="true"
                            data-url="{{ route('news.update', $post)}}"
                            data-method="PUT"
                            data-reload-on-success="1"
                            title="{{ trans('news.update.button') }}"
                            data-tooltip-position="left center"
                        >
                            <span class="btn-circle__content">
                                <i class="fas fa-sync"></i>
                            </span>
                        </button>
                    </div>
                @endif
            </div>
        @endslot
    @endcomponent

    <div class="osu-page osu-page--generic">
        <div class="news">
            <div class="news__time">
                {!! trans('news.show.posted', ['time' => timeago($post->published_at)]) !!}
            </div>

            {!! $post->bodyHtml() !!}

            <div class="news__nav">
                @if ($post->newer() === null)
                    <span
                        class="news__nav-button"
                        title="{{ trans('news.show.nav.newer') }}"
                    >
                        <span class="fas fa-chevron-circle-left"></span>
                    </span>
                @else
                    <a
                        class="news__nav-button news__nav-button--link"
                        href="{{ route('news.show', $post->newer()->slug) }}"
                        title="{{ trans('news.show.nav.newer') }}"
                    >
                        <span class="fas fa-chevron-circle-left"></span>
                    </a>
                @endif
                @if ($post->older() === null)
                    <span
                        class="news__nav-button"
                        title="{{ trans('news.show.nav.older') }}"
                    >
                        <span class="fas fa-chevron-circle-right"></span>
                    </span>
                @else
                    <a
                        href="{{ route('news.show', $post->older()->slug) }}"
                        class="news__nav-button news__nav-button--link"
                        title="{{ trans('news.show.nav.older') }}"
                    >
                        <span class="fas fa-chevron-circle-right"></span>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="osu-page osu-page--generic-compact">
        <div
            class="js-react--comments"
            data-props="{{ json_encode([
                'commentableType' => 'news_post',
                'commentableId' => $post->getKey(),
                'commentBundle' => $commentBundle->toArray(),
            ]) }}"
        ></div>
    </div>
@endsection
