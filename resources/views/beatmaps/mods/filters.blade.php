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
<div class="col-md-3 filters selector">
	Filters (click to show)

	<button class="filter-selector btn btn-block btn-danger" data-checked="1" data-target="resolved" data-class="btn-danger">
		{{{ Lang::get("beatmaps.modding.feedback.resolved") }}}
	</button>

	<button class="filter-selector btn btn-block btn-info " data-checked="1" data-target="praise" data-class="btn-info">
		{{{ Lang::choice("beatmaps.modding.feedback.praise", 2) }}}
	</button>

	<button class="filter-selector btn btn-block btn-warning" data-checked="1" data-target="suggestion" data-class="btn-warning">
		{{{ Lang::choice("beatmaps.modding.feedback.suggestion", 2) }}}
	</button>

	<button class="filter-selector btn btn-block btn-primary" data-checked="1" data-target="problem" data-class="btn-primary">
		{{{ Lang::choice("beatmaps.modding.feedback.problem", 2) }}}
	</button>

	<button class="filter-selector btn btn-block btn-success" data-checked="1" data-target="nomination" data-class="btn-success">
		{{{ Lang::choice("beatmaps.modding.feedback.nominate", 2) }}}
	</button>
</div>