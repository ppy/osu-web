{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@extends("master")

@section("content")
	<div id="forum-index-header" class="row-page">
		<div class="text-area">
			<div class="text">
				<h2>not so random subtitles.</h2>
				<h1>{{ trans("forum.title") }}</h1>
			</div>
		</div>
	</div>

	<div class="hidden-xs row-blank pippy"></div>

	<div class="row-blank row-page">
		@foreach($forums as $category)
			<div id="forum-{{ $category->forum_id }}" class="forum-category col-sm-12 forum-colour {{ $category->categorySlug() }}">
				<div class="row forum-category-header">
					<div class="name">{{ $category->forum_name }}</div>
					<div class="description">{{ $category->forum_desc }}</div>
				</div>

				@include("forum.forums._forums", ["forums" => $category->subforums])
			</div>
		@endforeach
	</div>
@endsection
