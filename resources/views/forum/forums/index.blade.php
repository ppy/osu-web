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
    'search' => [
        'url' => route('forum.forums.search'),
    ],
    'pageDescription' => trans('forum.title')
])

@section('content')
    <div class="osu-page">
        <div class="osu-page-header osu-page-header--forum-index">
            <div class="osu-page-header__title-box">
                <h2 class="osu-page-header__title osu-page-header__title--small">
                    {{ trans("forum.slogan") }}
                </h2>

                <h1 class="osu-page-header__title">
                    {{ trans("forum.title") }}
                </h1>
            </div>
        </div>
    </div>

    <div class="osu-page osu-page--forum-pippi">
        <div class="hidden-xs forum-pippi"></div>
    </div>

    <div class="osu-page">
        @foreach($forums as $category)
            <div id="forum-{{ $category->forum_id }}" class="
                forum-category
                col-sm-12
                t-forum-{{ $category->categorySlug() }}
            ">
                <div class="row forum-category-header forum-category-header--forum-index u-forum--bg">
                    <div class="forum-category-header__name">{{ $category->forum_name }}</div>
                    <div class="forum-category-header__description">{{ $category->forum_desc }}</div>
                </div>

                @include("forum.forums._forums", ["forums" => $category->subforums])
            </div>
        @endforeach

        <div class="forum-category col-sm-12">
            <div class="forums">
                <div class="forums__forum forums__forum--mark-as-read">
                    @include('forum.forums._mark_as_read')
                </div>
            </div>
        </div>
    </div>
@endsection
