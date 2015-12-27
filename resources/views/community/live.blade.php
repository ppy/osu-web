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
            <div class="wide col-sm-12 livestream-header__container">
                <div>
                    <h1 class="livestream-header__headline">{{ trans('livestreams.top-headers.headline') }}</h1>
                    <p class="livestream-header__description">{{ trans('livestreams.top-headers.description') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="osu-layout__row osu-layout__row--with-gutter osu-layout__row--page livestream-page">
    @if ($featuredStream != null)
        <h2 class="livestream-page__header">{{ trans('livestreams.headers.featured') }}</h2>
        <div class="livestream-featured">
                <a class="livestream-page__anchor-twitch" href="{{$featuredStream->channel->url}}" target="_blank"> 
                    <div class="wide col-sm-12 livestream-featured__container" style="background-image: url('{{$featuredStream->preview->large}}');">
                        <div class="livestream-featured__info">
                            <h3>{{$featuredStream->channel->name}}</h3>
                            <p>{{$featuredStream->channel->status}}</p>
                            <p>{{$featuredStream->viewers}} <i class="fa fa-eye"></i></p>
                        </div>
                    </div>
                </a>
                @if (Auth::user() != null && Auth::user()->isGmt())
                <div class="forum-post__actions">
                    <div class="forum-post-actions">
                        <a data-method="POST" class="forum-post-actions__action" href="live?unpromote=true">
                            <i class="fa fa-thumbs-down"></i>
                        </a>
                    </div>
                </div>
                @endif
        </div>
    @endif
        <h2 class="livestream-page__header">{{ trans('livestreams.headers.regular') }}</h2>
        @foreach ($streams as $stream)
            <div class="wide col-sm-4 livestream-regular">
                <a class="livestream-page__anchor-twitch" href="{{$stream->channel->url}}" target="_blank"> 
                    <div class="livestream-regular__container">
                        <div class="livestream-regular__top-background" style="background-image: url('{{$stream->preview->medium}}');">
                            <div class="livestream-regular__streamer-info">
                                {{$stream->channel->name}}
                            </div>
                            <div class="livestream-regular__watchers-info">
                                <p>{{$stream->viewers}} <i class="fa fa-eye"></i></p>
                            </div>
                        </div>
                        <div class="livestream-regular__bottom-info">
                            {{$stream->channel->status}}
                        </div>
                    </div>
                </a>
                @if (Auth::user() != null && Auth::user()->isGmt())
                <div class="forum-post__actions">
                    <div class="forum-post-actions">
                    <a data-method="POST" class="forum-post-actions__action" href="live?promote={{$stream->_id}}">
                        <i class="fa fa-thumbs-up"></i>
                    </a>
                    </div>
                </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
