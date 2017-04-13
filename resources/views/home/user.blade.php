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
@extends('master')

@section('content')
    <div class="osu-layout__row osu-layout__row--page-compact-no-margin osu-layout__row--sm1 osu-layout__row--full">
        <div class="osu-layout__sub-row osu-layout__sub-row--lg1-compact ">
            @include('home._user_header_nav')

            <div class="osu-page-header osu-page-header--two-col osu-page-header--home-user js-current-user-cover">
                <div class="osu-page-header__box osu-page-header__box--two-col">
                    <h1 class="osu-page-header__title osu-page-header__title--slightly-small osu-page-header__title--thinner u-ellipsis-overflow">
                        {!! trans('home.user.header.welcome', ['username' => Auth::user()->username]) !!}
                    </h1>
                    <p class="osu-page-header__detail">
                        <a class="osu-page-header__link" href="{{route('notifications.index')}}">
                            {{trans_choice('home.user.header.messages', Auth::user()->notificationCount())}}
                        </a>
                    </p>
                </div>

                <div class="osu-page-header__box osu-page-header__box--status osu-page-header__box--graph">
                    <div class="osu-page-header__status osu-page-header__status--fade-in">
                        <div class="osu-page-header__status-label">
                            Games
                        </div>
                        <div class="js-forum-topic-watch--unread osu-page-header__status-text">
                            {{$currentGames}}
                        </div>
                    </div>
                    <div class="osu-page-header__status osu-page-header__status--selected osu-page-header__status--fade-in osu-page-header__status--animation-delay">
                        <div class="osu-page-header__status-label">
                            {{trans('home.user.header.stats.online')}}
                        </div>
                        <div class="js-forum-topic-watch--unread osu-page-header__status-text">
                            {{$currentOnline}}
                        </div>
                    </div>
                    <div class="js-fancy-graph osu-page-header__status-chart" data-src="banchostats"></div>
                    <script id="banchostats" type="application/json">{!! json_encode($graphData) !!}</script>
                </div>
            </div>
        </div>

        <div class="user-home">
            <div class="user-home__news">
                <h2 class="user-home__news-title">{{trans('home.user.news.title')}}</h2>
                @if (!empty($news))
                    <div class="user-home__news-posts">
                        @foreach ($news as $post)
                            @if ($loop->iteration > 3)
                                @break
                            @endif

                            @include('home._user_news_post_preview', ['post' => $post, 'collapsed' => false])
                        @endforeach
                    </div>
                    @if (count($news) > 3)
                        <div class="user-home__news-posts user-home__news-posts--collapsed">
                            @foreach ($news as $post)
                                @if ($loop->iteration <= 3)
                                    @continue
                                @endif
                                @if ($loop->iteration > 8)
                                    @break
                                @endif

                                @include('home._user_news_post_preview', ['post' => $post, 'collapsed' => true])
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="user-home__news-fetch-error">{{trans('home.user.news.error')}}</div>
                @endif
            </div>
            <div class="user-home__right-sidebar">
                <div class="user-home__buttons">
                    @include('home._user_giant_button', [
                        'href' => route('download'),
                        'label' => trans('home.user.buttons.download'),
                        'icon' => 'download',
                        'colour' => 'btn-osu-big--pink'
                    ])
                    @include('home._user_giant_button', [
                        'href' => route('support-the-game'),
                        'label' => trans('home.user.buttons.support'),
                        'icon' => 'heart',
                        'colour' => 'btn-osu-big--green'
                    ])
                    @include('home._user_giant_button', [
                        'href' => route('store.products.index'),
                        'label' => trans('home.user.buttons.store'),
                        'icon' => 'shopping-cart',
                        'colour' => ''
                    ])
                </div>

                <h3 class='user-home__beatmap-list-title'>
                    {{ trans('home.user.beatmaps.new') }}
                </h3>

                @foreach ($newBeatmapsets as $beatmapset)
                    @include('home._user_beatmapset', ['type' => 'new'])
                @endforeach

                <h3 class='user-home__beatmap-list-title'>
                    {{ trans('home.user.beatmaps.popular') }}
                </h3>

                @foreach ($popularBeatmapsets as $beatmapset)
                    @include('home._user_beatmapset', ['type' => 'popular'])
                @endforeach
            </div>
        </div>
    </div>
@endsection
