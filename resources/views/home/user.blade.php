{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Models\NewsPost;

    $newsPostLargePreviews = NewsPost::LANDING_LIMIT;
@endphp
@extends('master')

@section('content')
    @include('home._user_header_default')

    <div class="osu-page">
        @if (count($menuImages) > 0)
            <div class="js-react--menu-images u-contents">
                <div class="menu-images menu-images--placeholder">
                    <div class="menu-images__images">
                        {!! spinner() !!}
                    </div>
                    @if (count($menuImages) > 1)
                        <div class="menu-images__indicators">
                            @foreach ($menuImages as $_i)
                                <div class="menu-images__indicator">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <div class="user-home">
            <div class="user-home__news">
                <h2 class="user-home__news-title">{{ osu_trans('home.user.news.title') }}</h2>

                @foreach ($news as $post)
                    @if ($loop->iteration > $newsPostLargePreviews)
                        @break
                    @endif

                    @include('home._user_news_post_preview', ['post' => $post, 'collapsed' => false])
                @endforeach

                @if (count($news) > $newsPostLargePreviews)
                    <div class="user-home__news-posts-group">
                        @foreach ($news as $post)
                            @if ($loop->iteration <= $newsPostLargePreviews)
                                @continue
                            @endif

                            @include('home._user_news_post_preview', ['post' => $post, 'collapsed' => true])
                        @endforeach
                    </div>
                @endif

                @if (count($news) > NewsPost::DASHBOARD_LIMIT)
                    <a
                        href="{{ route('news.index') }}"
                        class="user-home__news-posts-group user-home__news-posts-group--more"
                    >
                        {{ osu_trans('common.buttons.see_more') }}
                    </a>
                @endif
            </div>
            <div class="user-home__right-sidebar">
                <div class="user-home__status-box">
                    @include('home._user_online_status')
                </div>
                <div class="user-home__buttons">
                    <div class="user-home__button">
                        @include('home._user_giant_button', [
                            'href' => route('download'),
                            'label' => osu_trans('home.user.buttons.download'),
                            'icon' => 'download',
                        ])
                    </div>

                    <div class="user-home__button">
                        @include('home._user_giant_button', [
                            'href' => route('support-the-game'),
                            'label' => osu_trans('home.user.buttons.support'),
                            'icon' => 'heart',
                            'colour' => 'c-pink-darker'
                        ])
                    </div>

                    <div class="user-home__button">
                        @include('home._user_giant_button', [
                            'href' => route('store.products.index'),
                            'label' => osu_trans('home.user.buttons.store'),
                            'icon' => 'shopping-cart',
                            'colour' => 'c-darkorange'
                        ])
                    </div>
                </div>

                @if ($dailyChallenge)
                    <h3 class="user-home__beatmap-list-title">
                        <a href="{{ wiki_url("Gameplay/Daily_challenge") }}">
                            {{ osu_trans('home.user.beatmaps.daily_challenge') }}
                        </a>
                    </h3>

                    <div class="user-home__beatmapsets">
                        @include('home._user_beatmapset', ['type' => 'daily_challenge', 'beatmapset' => $dailyChallenge->currentPlaylistItem->beatmap->beatmapset, 'dailyChallenge' => $dailyChallenge])
                    </div>
                @endif

                <h3 class='user-home__beatmap-list-title'>
                    {{ osu_trans('home.user.beatmaps.new') }}
                </h3>

                <div class="user-home__beatmapsets">
                    @foreach ($newBeatmapsets as $beatmapset)
                        @include('home._user_beatmapset', ['type' => 'new'])
                    @endforeach
                </div>

                <h3 class='user-home__beatmap-list-title'>
                    {{ osu_trans('home.user.beatmaps.popular') }}
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

@section("script")
    @parent

    <script id="json-menu-images" type="application/json">
        {!! json_encode($menuImages) !!}
    </script>
@endsection
