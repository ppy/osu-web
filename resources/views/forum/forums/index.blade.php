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
    'legacyNav' => false,
    'pageDescription' => trans('forum.title'),
    'searchParams' => ['mode' => 'forum_post'],
])

@section('content')
    @include('forum._header', ['modifiers' => ['forums-index']])

    <div class="osu-page osu-page--forum">
        @foreach($forums as $category)
            <div id="forum-{{ $category->forum_id }}" class="forum-list">
                <div class="forum-list__header">
                    <div class="forum-title">
                        <h3 class="forum-title__name">{{ $category->forum_name }}</h3>
                        <p class="forum-title__description">{{ $category->forum_desc }}</p>
                    </div>

                    <div class="forum-list__buttons">
                        @include('forum.forums._mark_as_read', ['forum' => $category, 'recursive' => true])
                    </div>
                </div>

                <ul class="forum-list__items">
                    @foreach ($category->subforums as $forum)
                        @include('forum.forums._forum', compact('forum'))
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
@endsection
