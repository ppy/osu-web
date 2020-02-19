{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

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
@extends('master', [
    'currentAction' => 'profile',
    'currentSection' => 'community',
    'title' => trans('users.posts.title', ['username' => $user->username]),
])

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'backgroundImage' => $user->profileCustomization()->cover()->url(),
        'section' => trans('layout.header.users._'),
        'subSection' => trans('layout.header.users.forum_posts'),
    ]])
    <form action="{{ route('users.posts', request()->route('user')) }}">
        <div class="osu-page">
            <div class="search-header">
                <div class="search-header__title">
                    {{ trans('users.posts.title', ['username' => $user->username]) }}
                </div>

                <div class="search-header__box">
                    <input class="search-header__input" name="query" value="{{ request('query') }}" />

                    <button class="search-header__icon">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="osu-page">
            <div class="search">
                @include('objects.search._forum_options', ['fields' => ['user' => null]])

                <div class="search-result search-result--forum_post">
                    @if ($search->total() === 0)
                        <div class="search-result__row search-result__row--notice">
                            {{ trans('home.search.empty_result') }}
                        </div>
                    @else
                        <div class="search-result__row search-result__row--entries-container">
                            <div class="search-result__entries">
                                @php
                                    $users = $search->users()->select('user_id', 'username', 'user_avatar')->get();
                                @endphp
                                @foreach ($search->response() as $hit)
                                    <div class="search-result-entry">
                                        @include('objects.search._post_search', compact('hit', 'users'))
                                    </div>
                                @endforeach
                            </div>
                            <span class="search-result__more-button search-result__more-button--hidden">
                                {{-- ...because this element actually affects the layout --}}
                            </span>
                        </div>

                        <div class="search-result__row search-result__row--paginator">
                            @include('objects._pagination_v2', [
                                'object' => $search->getPaginator()->appends(request()->query()),
                                'modifier' => 'search',
                            ])
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
@endsection
