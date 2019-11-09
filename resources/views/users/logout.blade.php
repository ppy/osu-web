{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@section('content')
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
                    <button type="submit" class="form-control btn btn-info" id="nope" name="logout" value="no">Go Back <i class="fas fa-lg fa-undo"></i></button>
                </div>
            </div>
            <div class="col-xs-2"></div>
            <div class="col-xs-4">
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-info" id="yes" name="logout" value="yes">Logout <i class="fas fa-lg fa-sign-out-alt"></i></button>
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
