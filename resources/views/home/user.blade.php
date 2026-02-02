{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Models\NewsPost;

    $newsPostLargePreviews = NewsPost::LANDING_LIMIT;
    $currentUser = Auth::user();
    $queryForRecentBeatmapsets = 'ranked>'.json_date(Carbon\Carbon::now()->subDays(30));
@endphp
@extends('master')

@section('content')
    @include('home._user_header_default')

    <div class="osu-page">
        @if (count($menuImages) > 0)
            <div class="js-react u-contents" data-react="menu-images">
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
            <div class="user-home__left-section">
                @if ($featuredStream !== null)
                    <div class="user-home__livestream-section">
                        <h2 class="user-home__left-title">
                            <a href="{{ route('livestreams.index') }}">
                                {{ osu_trans('home.user.livestream.title') }}
                            </a>
                        </h2>
                        @include('home._user_livestream', ['stream' => $featuredStream])
                    </div>
                @endif

                <div class="user-home__news">
                    <h2 class="user-home__left-title">{{ osu_trans('home.user.news.title') }}</h2>

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
            </div>
            <div class="user-home__right-sidebar">
                <div class="user-home__status-box">
                    @include('home._user_online_status')
                </div>
                <div class="user-home__buttons">
                    @include('home._user_giant_button', [
                        'href' => route('download'),
                        'label' => osu_trans('home.user.buttons.download'),
                        'icon' => 'download',
                    ])

                    @include('home._user_giant_button', [
                        'href' => route('support-the-game'),
                        'label' => osu_trans('home.user.buttons.support'),
                        'icon' => 'heart',
                        'colour' => 'c-pink-darker'
                    ])

                    @include('home._user_giant_button', [
                        'href' => route('store.products.index'),
                        'label' => osu_trans('home.user.buttons.store'),
                        'icon' => 'shopping-cart',
                        'colour' => 'c-darkorange'
                    ])
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
                    <a href="{{ route('beatmapsets.index', ['q' => $queryForRecentBeatmapsets]) }}">
                        {{ osu_trans('common.buttons.see_more') }}
                    </a>
                </div>

                <h3 class='user-home__beatmap-list-title'>
                    {{ osu_trans('home.user.beatmaps.popular') }}
                </h3>

                <div class="user-home__beatmapsets">
                    @foreach ($popularBeatmapsets as $beatmapset)
                        @include('home._user_beatmapset', ['type' => 'popular'])
                    @endforeach
                    <a href="{{ route('beatmapsets.index', ['q' => $queryForRecentBeatmapsets, 'sort' => 'favourites_desc']) }}">
                        {{ osu_trans('common.buttons.see_more') }}
                    </a>
                </div>
            </div>
        </div>

        @if ($currentUser !== null && $currentUser->isAdmin())
            <div class="admin-menu">
                <button class="admin-menu__button js-menu" data-menu-target="admin-menu-forums-show">
                    <span class="fas fa-angle-up"></span>
                    <span class="admin-menu__button-icon fas fa-tools"></span>
                </button>

                <div class="admin-menu__menu js-menu" data-menu-id="admin-menu-forums-show" data-visibility="hidden">
                    <a class="admin-menu-item" href="{{ route('admin.root') }}" target="_blank">
                        <span class="admin-menu-item__content">
                            <span class="admin-menu-item__label admin-menu-item__label--icon">
                                <span class="fas fa-terminal"></span>
                            </span>

                            <span class="admin-menu-item__label admin-menu-item__label--text">
                                {{ osu_trans('home.user.show.admin.page') }}
                            </span>
                        </span>
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection

@section("script")
    @parent

    <script id="json-menu-images" type="application/json">
        {!! json_encode($menuImages) !!}
    </script>
@endsection
