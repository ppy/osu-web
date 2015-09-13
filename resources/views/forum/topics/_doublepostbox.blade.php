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
$display = "inherit";

if ($hide)
    $display = "none";
?>
<div id="{{ $id }}" class="row-page flex-row forum-post-box-warning" style="display:{{ $display }}">
    <div class="iconbox">
        <i class="fa fa-info-circle"></i>
    </div>
    <p>You just posted. Please wait a bit or <a data-remote="1" target="{{ $lastPostId }}" class="edit-post-link" href="{{ route("forum.posts.edit", $lastPostId) }}">edit your previous post</a>.
</div>
