{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'titlePrepend' => osu_trans('users.posts.title', ['username' => $user->username]),
])

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'backgroundImage' => $user->profileCustomization()->cover()->url(),
    ]])
    <form action="{{ route('users.posts', request()->route('user')) }}">
        <div class="osu-page">
            <div class="search-header">
                <div class="search-header__title">
                    {{ osu_trans('users.posts.title', ['username' => $user->username]) }}
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
                            {{ osu_trans('home.search.empty_result') }}
                        </div>
                    @else
                        <div class="search-result__row search-result__row--entries-container">
                            <div class="search-result__entries">
                                @include('home._search_result_forum_post', compact('search'))
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
