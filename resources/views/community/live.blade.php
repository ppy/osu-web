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
        <div class="osu-layout__row--page header-row livestreams__header">
            <div class="wide col-sm-12 livestreams__header--container">
                <div>
                    <h1>Live Streams</h1>
                    <p>Data is fetched from twitch.tv every five minutes based on the directory listing. Feel free to start streaming and get yourself listed! For more information on how to get setup, please check out the wiki page on live streaming.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="osu-layout__row osu-layout__row--with-gutter osu-layout__row--page livestreams__row">
    {{--
        <h2>Featured live stream</h2>
        <div class="livestream__main--col">
            <div class="wide col-sm-12 livestream__main">
                <div class="livestream__main--info">
                    <h3>Kano</h3>
                    <p>
                        Kano | 2.8k mouse-hybrid - 2k
                        <br/>
                        follower hype
                    </p>
                    <p>
                        5,264 <i class="fa fa-eye"></i>
                    </p>
                </div>
            </div>
        </div>
        --}}
        <h2>Live streams</h2>
        @foreach ($streams as $stream)
        <a href="{{$stream->channel->url}}">
            <div class="wide col-sm-4 livestream__regular--col">
                <div class="livestream__regular">
                    <div class="livestream__regular--background" style="background-image: url('{{$stream->preview->medium}}');">
                        <div class="livestream__regular--background-streamer">
                            <h2>{{$stream->channel->name}}</h2>
                        </div>
                        <div class="livestream__regular--background-watchers">
                            <p>{{$stream->viewers}} <i class="fa fa-eye"></i></p>
                        </div>
                    </div>
                    <div class="livestream__regular--info">
                        <p>{{$stream->channel->status}}</p>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
