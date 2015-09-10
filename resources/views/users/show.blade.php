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
@extends("master", [
	'current_section' => 'community',
	'current_action' => 'profile',
	'title' => trans('users.show.title', ['username' => $user->username]),
	'pageDescription' => trans('users.show.page_description', ['username' => $user->username])
])

@section("content")
	{{--
		this should content a server side react.js render which doesn't exist in hhvm
		because the only library for it, which is experimental, requires PHP extension
		which isn't supported by hhvm (v8js).
	--}}
@endsection

@section ("script")
	@parent

	<script data-turbolinks-eval="always">
		window.userPlaymode = '{{ $user->playmode }}';
		window.changeCoverUrl = '{{ route("account.update-profile-cover") }}';
		window.changePageUrl = '{{ route("account.page") }}';
	</script>

	<script id="json-user-achievements-counts" type="application/json">
		{!! json_encode($achievementsCounts) !!}
	</script>

	<script id="json-user-recent-achievements" type="application/json">
		{!! json_encode($recentAchievements) !!}
	</script>

	<script id="json-user-info" type="application/json">
		{!! json_encode($userArray) !!}
	</script>

	<script id="json-user-stats" type="application/json">
		{!! json_encode($allStats) !!}
	</script>

	<script id="json-user-page" type="application/json">
		{!! json_encode(["page" => $userPage]) !!}
	</script>

	<script id="json-user-recent-activities" type="application/json">
		{!! json_encode($recentActivities) !!}
	</script>

	<script id="json-post-editor-toolbar" type="application/json">
		{!! json_encode(["html" => view()->make('forum._post_toolbar')->render()]) !!}
	</script>

	<script src="{{ elixir("js/jsx/profile_page.js") }}" data-turbolinks-eval="always" data-turbolinks-track></script>
@endsection
