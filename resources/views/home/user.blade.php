{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@php
    $user = auth()->user();
    $profileCustomization = $user->userProfileCustomization ?? $user->userProfileCustomization()->make();
    $beatmapsetShowNsfw = $profileCustomization->beatmapset_show_nsfw;
@endphp

@section('content')
    @include('home._user_header_default')

    <div class="osu-page">
        <div class="user-home">
            <div class="user-home__news">
                <h2 class="user-home__news-title">{{ osu_trans('home.user.news.title') }}</h2>

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

                <h3 class='user-home__beatmap-list-title'>
                    {{ osu_trans('home.user.beatmaps.new') }}
                </h3>

                <div class="user-home__beatmapsets">
                    @foreach ($newBeatmapsets as $beatmapset)
                        @include('home._user_beatmapset', ['type' => 'new', 'showNsfw' => $beatmapsetShowNsfw])
                    @endforeach
                </div>

                <h3 class='user-home__beatmap-list-title'>
                    {{ osu_trans('home.user.beatmaps.popular') }}
                </h3>

                <div class="user-home__beatmapsets">
                    @foreach ($popularBeatmapsets as $beatmapset)
                        @include('home._user_beatmapset', ['type' => 'popular', 'showNsfw' => $beatmapsetShowNsfw])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
