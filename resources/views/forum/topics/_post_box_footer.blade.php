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
<?php
	if (!isset($editing)) { $editing = false; }
?>
<div class="post-box__toolbar">
	<div class="create-post-advanced">
		@include("forum._post_toolbar")
	</div>

	<div class="create-post-basic">
		<div class="create-post-advanced-switch">
			<span class="create-post-advanced-hide">
				<i class="fa fa-angle-double-up"></i>
				{{ trans("forum.post.create.advanced.hide") }}
			</span>

			<span>
				<i class="fa fa-angle-double-down"></i>
				{{ trans("forum.post.create.advanced.show") }}
			</span>
		</div>
	</div>
</div>

<div class="post-box__actions {{ $editing ? "post-box__actions--edit" : "" }}">
	@if ($editing)
		<button class="btn-osu btn-osu-lite js-edit-post-cancel" type="button">{{ trans("forum.topic.post_edit.cancel") }}</button>
	@endif

	<button class="btn-osu btn-osu-lite" type="submit">{{ $submitText }}</button>
</div>
