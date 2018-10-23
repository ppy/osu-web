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
    @include('home._user_header_default', [
        'title' => trans('home.user.header.welcome', ['username' => link_to(
            route('users.show', Auth::user()),
            Auth::user()->username,
            ['class' => 'link link--white']
        )])
    ])

    <div class="osu-page osu-page--small-desktop">
        <div class="user-home">
            <div class="user-home__news">
                <h2 class="user-home__news-title">{{ trans('home.user.news.title') }}</h2>

                @foreach ($news as $post)
                    @if ($loop->iteration > 3)
                        @break
                    @endif

                    @include('home._user_news_post_preview', ['post' => $post, 'collapsed' => false])
                @endforeach

                @if (count($news) > 3)
                    <div class="user-home__news-posts-group">
                        @foreach ($news as $post)
                            @if ($loop->iteration <= 3)
                                @continue
                            @endif

                            @include('home._user_news_post_preview', ['post' => $post, 'collapsed' => true])
                        @endforeach
                    </div>
                @endif

                @if (count($news) > App\Models\NewsPost::DASHBOARD_LIMIT)
                    <a
                        href="{{ route('news.index') }}"
                        class="user-home__news-posts-group user-home__news-posts-group--more"
                    >
                        {{ trans('common.buttons.see_more') }}
                    </a>
                @endif
            </div>
            <div class="user-home__right-sidebar">
                <div class="user-home__buttons">
                    <div class="user-home__button">
                        @include('home._user_giant_button', [
                            'href' => route('download'),
                            'label' => trans('home.user.buttons.download'),
                            'icon' => 'download',
                        ])
                    </div>

                    <div class="user-home__button">
                        @include('home._user_giant_button', [
                            'href' => route('support-the-game'),
                            'label' => trans('home.user.buttons.support'),
                            'icon' => 'heart',
                            'colour' => 'green'
                        ])
                    </div>

                    <div class="user-home__button">
                        @include('home._user_giant_button', [
                            'href' => route('store.products.index'),
                            'label' => trans('home.user.buttons.store'),
                            'icon' => 'shopping-cart',
                            'colour' => 'pink-darker'
                        ])
                    </div>
                </div>

                <h3 class='user-home__beatmap-list-title'>
                    {{ trans('home.user.beatmaps.new') }}
                </h3>

                <div class="user-home__beatmapsets">
                    @foreach ($newBeatmapsets as $beatmapset)
                        @include('home._user_beatmapset', ['type' => 'new'])
                    @endforeach
                </div>

                <h3 class='user-home__beatmap-list-title'>
                    {{ trans('home.user.beatmaps.popular') }}
                </h3>

                <div class="user-home__beatmapsets">
                    @foreach ($popularBeatmapsets as $beatmapset)
                        @include('home._user_beatmapset', ['type' => 'popular'])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
