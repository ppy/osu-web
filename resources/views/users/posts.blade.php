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
@extends("master", [
    'current_section' => 'community',
    'current_action' => 'profile',
    'title' => trans('users.posts.title', ['username' => $user->username]),
    'pageDescription' => trans('users.posts.page_description', ['username' => $user->username]),
])

@section('content')
    <form action="{{ route('users.posts', request()->route('user')) }}">
        <div class="osu-page">
            <div class="search-header">
                <div class="search-header__title">
                    {{ trans('users.posts.title', ['username' => $user->username]) }}
                </div>

                <div class="search-header__box">
                    <input class="search-header__input" name="query" value="{{ request('query') }}" />

                    <button class="search-header__icon">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="osu-page osu-page--small-desktop">
            <div class="search">
                <div class="page-mode page-mode--search">
                </div>

                @include('search._forum_options', ['fields' => ['user' => false]])

                <div class="search-result search-result--forum_post">
                    <div class="search-result__row search-result__row--entries-container">
                        <div class="search-result__entries">
                            @foreach ($search as $hit)
                                <div class="search-result__entry">
                                    @include('search._post_search', compact('hit'))
                                </div>
                            @endforeach
                        </div>
                        <span class="search-result__more-button search-result__more-button--hidden">
                            {{-- ...because this element actually affects the layout --}}
                        </span>
                    </div>

                    <div class="search-result__row search-result__row--paginator">
                        @include('objects._pagination', ['object' => $search, 'modifier' => 'search'])
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
