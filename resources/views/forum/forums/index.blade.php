{{--
    Copyright 2015 ppy Pty. Ltd.

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
@extends("master")

@section("content")
    <div id="forum-index-header" class="osu-layout__row osu-layout__row--page">
        <div class="text-area">
            <div class="text">
                <h2>it's dangerous to play alone.</h2>
                <h1>{{ trans("forum.title") }}</h1>
            </div>
        </div>
    </div>

    <div class="hidden-xs osu-layout__row osu-layout__row--lg2">
        <div class="pippy"></div>
    </div>

    <div class="osu-layout__row">
        @foreach($forums as $category)
            <div id="forum-{{ $category->forum_id }}" class="forum-category col-sm-12 forum-colour {{ $category->categorySlug() }}">
                <div class="row forum-category-header forum-colour__bg--{{ $category->categorySlug() }}">
                    <div class="forum-category-header__name">{{ $category->forum_name }}</div>
                    <div class="forum-category-header__description">{{ $category->forum_desc }}</div>
                </div>

                @include("forum.forums._forums", ["forums" => $category->subforums])
            </div>
        @endforeach
    </div>
@endsection
