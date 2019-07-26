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
<div class="form-group">
    <button class="btn btn-danger btn-block" data-toggle="collapse" data-target="#bat-tools">Moderator Tools</button>
</div>
<div class="row mod-tools collapse" id="bat-tools">
    <div class="col-xs-12">
        {!! Form::open(["class" => "form-horizontal"]) !!}
            <div class="form-group">
                <label for="beatmap-title" class="control-label col-sm-2">{{{ trans("beatmaps.modding.metadata.title") }}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{{ $beatmap["title"] }}}" placeholder="{{{ trans("beatmaps.modding.metadata.title") }}}">
                </div>
            </div>
            <div class="form-group">
                <label for="beatmap-title" class="control-label col-sm-2">{{{ trans("beatmaps.modding.metadata.artist") }}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{{ $beatmap["artist"] }}}" placeholder="{{{ trans("beatmaps.modding.metadata.artist") }}}">
                </div>
            </div>
            <div class="form-group">
                <label for="beatmap-title" class="control-label col-sm-2">{{{ trans("beatmaps.modding.metadata.tags") }}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{{ $beatmap["tags"] }}}" placeholder="{{{ trans("beatmaps.modding.metadata.tags") }}}">
                </div>
            </div>
            <div class="form-group">
                <label for="beatmap-title" class="control-label col-sm-2">{{{ trans("beatmaps.modding.metadata.source") }}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{{ $beatmap["source"] }}}" placeholder="{{{ trans("beatmaps.modding.metadata.source") }}}">
                </div>
            </div>
            <div class="form-group">
                <label for="beatmap-title" class="control-label col-sm-2">{{{ trans("beatmaps.modding.metadata.unicode.title") }}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{{ $beatmap["title_unicode"] }}}" placeholder="{{{ trans("beatmaps.modding.metadata.unicode.title") }}}">
                </div>
            </div>
            <div class="form-group">
                <label for="beatmap-title" class="control-label col-sm-2">{{{ trans("beatmaps.modding.metadata.unicode.artist") }}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{{ $beatmap["artist_unicode"] }}}" placeholder="{{{ trans("beatmaps.modding.metadata.unicode.artist") }}}">
                </div>
            </div>

            <div class="form-group">
                <h3 class="text-danger col-sm-12">Danger Zone&trade;</h3>
                <div class="col-sm-6">
                    <button class="btn btn-warning btn-large form-control">
                        {{{ trans("beatmaps.bat-tools.buttons.delete-map") }}}
                    </button>
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-danger btn-large form-control">
                        {{{ trans("beatmaps.bat-tools.buttons.unrank-map") }}}
                    </button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <button class="btn btn-info btn-large form-control">
                        {{{ trans("beatmaps.bat-tools.buttons.delete-scores") }}}
                    </button>
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-primary btn-large form-control">
                        {{{ trans("beatmaps.bat-tools.buttons.graveyard-map") }}}
                    </button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
