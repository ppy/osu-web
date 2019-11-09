{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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

    <div class="osu-page osu-page--small">
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
