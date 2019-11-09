{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'currentSection' => 'community',
    'currentAction' => 'profile',
    'title' => trans('users.posts.title', ['username' => $user->username]),
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
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="osu-page osu-page--small">
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
