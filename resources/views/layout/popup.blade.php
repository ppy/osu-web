{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if (Session::has("popup"))
    <div style="padding-left: 50px; padding-right: 50px">
        <div class="alert alert-dismissable alert-info">
            <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{{ osu_trans(Session::get("popup")) }}}
        </div>
    </div>
@endif
