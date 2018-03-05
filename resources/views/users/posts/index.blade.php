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
    <form action="{{ route('search') }}">
        <input type="hidden" name="mode" value="post_search">

        <div class="osu-page">
            <div class="search-header">
                <div class="search-header__title">
                    {{ trans('home.search.title') }}
                </div>

                <div class="search-header__box">
                    <input class="search-header__input" name="query" value="" />

                    <button class="search-header__icon">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="osu-page osu-page--small-desktop">
            <div class="search">
                <div class="search-result search-result--post-search">
                    <div class="search-result__row search-result__row--entries-container">
                        <div class="search-result__entries">
                            @foreach ($search as $hit)
                                @php
                                    $postUrl = post_url($hit->source('topic_id'), $hit->source('post_id'));
                                @endphp

                                <div class="search-result__entry">
                                    <a class="search-entry" href="{{ $postUrl }}">
                                        <div class="search-entry__row search-entry__row--excerpt">
                                            {{ html_excerpt($hit->source('search_content')) }}
                                        </div>
                                        <p class="search-entry__row search-entry__row--footer">
                                            {{ $postUrl }}
                                        </p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="search-result__row search-result__row--paginator">
                        @include('objects._pagination', ['object' => $search, 'modifier' => 'search'])
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
