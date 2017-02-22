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
    <div class="osu-layout__row osu-layout__row--page-compact osu-layout__row--sm1 osu-layout__row--full t-forum-category-osu">
        <div class="osu-layout__sub-row osu-layout__sub-row--lg1-compact ">
            @include('home._user_header_nav')

            <div class="osu-page-header osu-page-header--two-col osu-page-header--home-user js-current-user-cover">
                <div class="osu-page-header__box osu-page-header__box--two-col">
                    <h1 class="osu-page-header__title osu-page-header__title--slightly-small u-ellipsis-overflow">
                        Hello, {{Auth::user()->username}}!
                    </h1>
{{--
                    <p class="osu-page-header__detail">
                        You have {{Auth::user()->notificationCount()}} new notifications
                    </p>
--}}
                    <p class="osu-page-header__detail">
                        You have {{Auth::user()->notificationCount()}} new messages
                    </p>
                </div>

                <div class="osu-page-header__box osu-page-header__box--status" style="padding: 0; height: 100px; padding-top: 5px; justify-content: flex-end; flex: 100%; margin: 0;">
                    <div class="osu-page-header__status" style="padding-right: 20px;">

                        <div class="osu-page-header__status-label">
                            Online Users
                        </div>
                        <div class="js-forum-topic-watch--unread osu-page-header__status-text">
                            {{ number_format($stats->last()->users_osu) }}
                        </div>
                    </div>
                    <div class="js-online-graph landing-graph"></div>
                </div>
            </div>
        </div>

        <div class="user-home">
            <div class="user-home__news">
                <h2 style="margin: 0px; font-size: 20px; margin-bottom: 10px; margin-left: 10px; color: #FF99CC; font-weight: 100;">News</h2>
                <div class="news-posts">
                    @foreach ($news->posts as $post)
                        @php
                            $post_images = find_images($post->body);
                            $post_image = '';
                            if (is_array($post_images)) {
                                if (count($post_images) > 0) {
                                    $post_image = $post_images[0];
                                }
                            } else {
                                $post_image = $post_images;
                            }
                        @endphp
                        @if ($loop->iteration > 8)
                            @break;
                        @endif
                        <div class="news-post-preview{{ $loop->iteration > 3 ? ' news-post-preview--collapsed' : '' }}">
                            <div class="news-post-preview__image" style="background-image: url({{$post_image}});"></div>
                            <div class="news-post-preview__body">
                                <div class="news-post-preview__post-date">
                                    <div class="news-post-preview__date">{{ Carbon\Carbon::parse($post->date)->formatLocalized('%d') }}</div>
                                    <div class="news-post-preview__month-year">{{ Carbon\Carbon::parse($post->date)->formatLocalized($loop->iteration > 3 ? '&nbsp;%b' : '%b %Y') }}</div>
                                </div>
                                <div class="news-post-preview__post-right">
                                    <div class="news-post-preview__post-title u-ellipsis-overflow">
                                        {{$post->title}}
                                    </div>
                                    <div class="news-post-preview__post-content"><p>{!! first_paragraph($post->body) !!}</p></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="user-home__right-sidebar">
                <div class="right-sidebar__buttons" style="display: flex;">
                    <a href="#" class='btn-osu-big'>{{--  style="flex-basis: 100%; margin-right: 5px;"> --}}
                        <div class='btn-osu-big__content' style="flex-direction: column;">
                            <div class='btn-osu-big__left' style='align-items: center;'>
                                <span class='btn-osu-big__text-top' style='margin-bottom: 5px;'>Download osu!</span>
                                <div class='btn-osu-big__icon' style='margin-left: 0px; font-size: 100%;'>
                                    <i class='fa fa-fw fa-download'></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class='btn-osu-big'>{{--  style="flex-basis: 100%; margin-right: 5px;"> --}}
                        <div class='btn-osu-big__content' style="flex-direction: column;">
                            <div class='btn-osu-big__left' style='align-items: center;'>
                                <span class='btn-osu-big__text-top' style='margin-bottom: 5px;'>Support osu!</span>
                                <div class='btn-osu-big__icon' style='margin-left: 0px; font-size: 100%;'>
                                    <i class='fa fa-fw fa-heart'></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class='btn-osu-big'>{{--  style="flex-basis: 100%; margin-right: 5px;"> --}}
                        <div class='btn-osu-big__content' style="flex-direction: column;">
                            <div class='btn-osu-big__left' style='align-items: center;'>
                                <span class='btn-osu-big__text-top' style='margin-bottom: 5px;'>osu!store</span>
                                <div class='btn-osu-big__icon' style='margin-left: 0px; font-size: 100%;'>
                                    <i class='fa fa-fw fa-shopping-cart'></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="user-home__beatmap-lists">
                    <div class='user-home-beatmap-list'>
                        <h3 class='user-home-beatmap-list__heading'>New Approved Beatmaps</h3>
                        @foreach ($newBeatmaps as $beatmap)
                            <a class='user-home-beatmap-list__beatmap' href="{{route('beatmapsets.show', $beatmap->beatmapset_id)}}">
                                <div class='user-home-beatmap-list__cover' style="background-image: url({{$beatmap->allCoverURLs()['list']}});"></div>
                                <div class="user-home-beatmap-list__meta">
                                    <div class='user-home-beatmap-list__title u-ellipsis-overflow'>{{$beatmap->title}}</div>
                                    <div class='user-home-beatmap-list__artist u-ellipsis-overflow'>{{$beatmap->artist}}</div>
                                    <div class='user-home-beatmap-list__creator u-ellipsis-overflow'>
                                        by {{$beatmap->creator}}, <span class='user-home-beatmap-list__playcount'>{!! timeago($beatmap->approved_date) !!}</span>
                                    </div>
                                </div>
                                <div class='user-home-beatmap-list__chevron'><i class='fa fa-fw fa-chevron-right'></i></div>
                            </a>
                        @endforeach
                    </div>
                    <div class='user-home-beatmap-list'>
                        <h3 class='user-home-beatmap-list__heading'>Popular Beatmaps</h3>
                        @foreach ($popularBeatmaps as $beatmap)
                            <a class='user-home-beatmap-list__beatmap' href="{{route('beatmapsets.show', $beatmap->beatmapset_id)}}">
                                <div class='user-home-beatmap-list__cover' style="background-image: url({{$beatmap->allCoverURLs()['list']}});"></div>
                                <div class="user-home-beatmap-list__meta">
                                    <div class='user-home-beatmap-list__title u-ellipsis-overflow'>{{$beatmap->title}}</div>
                                    <div class='user-home-beatmap-list__artist u-ellipsis-overflow'>{{$beatmap->artist}}</div>
                                    <div class='user-home-beatmap-list__creator u-ellipsis-overflow'>
                                        by {{$beatmap->creator}}, <span class='user-home-beatmap-list__playcount'>{{number_format($popularBeatmapsPlaycount[$beatmap->beatmapset_id])}} plays</span>
                                    </div>
                                </div>
                                <div class='user-home-beatmap-list__chevron'><i class='fa fa-fw fa-chevron-right'></i></div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section ("script")
    @parent

    <script id="json-stats" type="application/json">
        {!! json_encode($stats) !!}
    </script>
@endsection
