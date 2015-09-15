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
@section("content")
    <div class="row">
        <center>
            <h1>Are you sure you want to log out?</h1>
        </center>

        <br>

        {!! Form::open(["url" => "user/logout", "class" => "form-horizontal", "role" => "form"])!!}
            <input type="hidden" name="redirect" value="{{{ $redirect }}}">
            <div class="col-xs-1"></div>
            <div class="col-xs-4">
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-info" id="nope" name="logout" value="no">Go Back <i class="fa fa-lg fa-undo"></i></button>
                </div>
            </div>
            <div class="col-xs-2"></div>
            <div class="col-xs-4">
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-info" id="yes" name="logout" value="yes">Logout <i class="fa fa-lg fa-sign-out"></i></button>
                </div>
            </div>
            <div class="col-xs-1"></div>
        {!! Form::close() !!}
    </div>
@stop

@section("script")
    <script>
    window.csrf = "{{{ csrf_token() }}}";
    </script>
@stop
