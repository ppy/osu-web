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
<br>
<div class="row">
	<div class="col-xs-7 comment-section">
		@include("beatmaps.mods.comment-frame")

		<div class="col-xs-12 comments-missing" style="display: none">
			<h3 class="text-center text-muted">
				{{{ trans("beatmaps.modding.comments.missing") }}}
			</h3>
		</div>

		<div id="comments" class="live-object" data-uri="/api/mod-comments/{{ $set->beatmapset_id }}"></div>
	</div>
	<div class="col-xs-5">
		<table class="table table-condensed table-hover" id="stats-table">
			<tbody>
				<tr class="active">
					<td>All</td>
					<td class="text-right"><span class="green-dark"><i class="fa fa-check-circle-o"></i> <span id="session-resolved">0</span></span> <span class="pink-darker"><i class="fa fa-times-circle-o"></i> <span id="session-pending">0</span></span></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
