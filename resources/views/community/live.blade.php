{{--
    Copyright 2015 ppy Pty. Ltd.

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
@extends("master")

@section('content')

<div class="osu-layout__row osu-layout__row--page-compact">
    <div class="osu-page-header osu-page-header--live">
            <h1 class="osu-page-header__title">{{ trans('livestreams.top-headers.headline') }}</h1>

            <p class="osu-page-header__title osu-page-header__title--smaller">
                {{ trans('livestreams.top-headers.description') }}
            </p>
    </div>
</div>

@if ($featuredStream !== null)
    <div class="osu-layout__row osu-layout__row--page-compact">
        <div class="livestream-featured">
            <iframe
                class="livestream-featured__content"
                src="//player.twitch.tv/?channel={{ $featuredStream->channel->name }}&muted=true"
                frameborder="0"
                scrolling="no"
                allowfullscreen="false"
            ></iframe>

            <a
                href="{{ $featuredStream->channel->url }}"
                class="livestream-featured__content livestream-featured__content--overlay"
            >
                <h2 class="livestream-featured__text livestream-featured__text--header">
                    {{ trans('livestreams.headers.featured') }}
                </h2>

                <div class="livestream-featured__info">
                    <h3 class="livestream-featured__text livestream-featured__text--name">
                        {{ $featuredStream->channel->name }}
                    </h3>

                    <p class="livestream-featured__text livestream-featured__text--detail">
                        {{ $featuredStream->channel->status }}
                    </p>

                    <p class="livestream-featured__text livestream-featured__text--detail">
                        {{ $featuredStream->viewers }} <i class="fa fa-eye"></i>
                    </p>
                </div>
            </a>

            @if (Auth::check() && Auth::user()->isGMT())
                <div class="livestream-featured__actions">
                    <div class="forum-post-actions">
                        <a data-method="POST" class="forum-post-actions__action" href="{{route('live', ['demote' => true])}}">
                            <i class="fa fa-thumbs-down"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif

<div class="osu-layout__row osu-layout__row--page-compact">
    <div class="livestream-page">
        <h2 class="livestream-page__header">
            {{ trans('livestreams.headers.regular') }}
        </h2>

        <div class="livestream-page__items">
            @foreach ($streams as $stream)
                <div class="livestream-item">
                    <a class="livestream-item__content" href="{{$stream->channel->url}}">
                        <div
                            class="livestream-item__image"
                            style="background-image: url('{{$stream->preview->medium}}');"
                        ></div>

                        <p class="livestream-item__text livestream-item__text--name">
                            {{$stream->channel->name}}
                        </p>

                        <p class="livestream-item__text livestream-item__text--detail">
                            {{$stream->viewers}} <i class="fa fa-eye"></i>
                        </p>
                    </a>

                    @if (Auth::check() && Auth::user()->isGMT())
                        <div class="livestream-item__actions">
                            <div class="forum-post-actions">
                                <a data-method="POST" class="forum-post-actions__action" href="{{route('live', ['promote' => $stream->_id])}}">
                                    <i class="fa fa-thumbs-up"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
