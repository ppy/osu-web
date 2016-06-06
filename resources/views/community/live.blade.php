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

<div class="osu-layout__section osu-layout__section--full livestreams">
    <div class="osu-layout__row osu-layout__row--with-gutter">
        <div class="osu-layout__row--page header-row livestream-header">
            <div class="col-sm-12 livestream-header__container">
                <div>
                    <h1 class="livestream-header__headline">{{ trans('livestreams.top-headers.headline') }}</h1>
                    <p class="livestream-header__description">{{ trans('livestreams.top-headers.description') }}</p>
                </div>
            </div>
        </div>
    </div>
    @if ($featuredStream !== null)
        <div class="osu-layout__row osu-layout__row--with-gutter livestream-featured">
            <iframe
                src="//player.twitch.tv/?channel={{ $featuredStream->channel->name }}"
                frameborder="0"
                scrolling="no"
                allowfullscreen="false">
            </iframe>
            <div class="livestream-featured__container">
                <a href="{{ $featuredStream->channel->url }}">
                    <h3 class="livestream-featured__header">{{ trans('livestreams.headers.featured') }}</h3>
                    <div class="livestream-featured__info">
                        <p class="livestream-featured__name">{{ $featuredStream->channel->name }}</p>
                        <p>{{ $featuredStream->channel->status }}</p>
                        <p>{{ $featuredStream->viewers }} <i class="fa fa-eye"></i></p>
                    </div>
                </a>
            </div>
            @if (Auth::user() != null && Auth::user()->isGmt())
                <div class="livestream-featured__actions">
                    <div class="forum-post-actions">
                        <a data-method="POST" class="forum-post-actions__action" href="{{route('live', ['demote' => true])}}">
                            <i class="fa fa-thumbs-down"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    @endif
    <div class="osu-layout__row osu-layout__row--with-gutter osu-layout__row--page-compact livestream-page">
        <h3 class="livestream-regular__header">{{ trans('livestreams.headers.regular') }}</h3>
        @foreach ($streams as $stream)
            <div class="col-sm-4 livestream-regular">
                <div class="livestream-regular__container">
                    <a class="livestream-page__anchor-twitch" href="{{ $stream->channel->url }}" target="_blank">
                        <img class="livestream-regular__thumbnail" src="{{ $stream->preview->large }}" alt="{{ $stream->channel->name }}">
                        <div class="livestream-regular__info">
                            <p class="livestream-regular__name">{{ $stream->channel->name }}</p>
                            <p class="livestream-regular__viewers">{{ $stream->viewers }} <i class="fa fa-eye"></i></p>
                        </div>
                    </a>
                    @if (Auth::user() != null && Auth::user()->isGmt())
                        <div class="livestream-regular__actions">
                            <div class="forum-post-actions">
                                <a data-method="POST" class="forum-post-actions__action" href="{{route('live', ['promote' => $stream->_id])}}">
                                    <i class="fa fa-thumbs-up"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
