{{--
    Copyright 2016 ppy Pty. Ltd.

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
@extends("master")

@section("content")
    <div class="js-react--mp-history"></div>
@endsection

@section("script")
    @parent
    <script id="json-match" type="application/json">
        {!! json_encode($match) !!}
    </script>

    <script>
        var full = {!! json_encode($full) !!};
    </script>

    <script src="{{ elixir("js/react/mp-history.js") }}" data-turbolinks-track></script>
@endsection
