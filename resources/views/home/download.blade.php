{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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
    <div id="download-header" class="osu-layout__row osu-layout__row--page">
        <p>{{ trans('home.download.header.1') }}</p>
        <p>{{ trans('home.download.header.2') }}</p>
        <p>{{ trans('home.download.header.3') }}</p>
    </div>

    <div class="osu-layout__row" id="download-button">
        <a href="http://m1.ppy.sh/r/osu!install.exe">
            <img class="round" src="/images/download-button.png" alt="osu! online installer" />
        </a>
    </div>

    <div class="osu-layout__row osu-layout__row--page" id="download-steps">
        <div>
            <h1>{{ trans('home.download.steps.1.name') }}</h1>
            <p>{{ trans('home.download.steps.1.content') }}</p>
        </div>
        <div>
            <h1>{{ trans('home.download.steps.2.name') }}</h1>
            <p>{{ trans('home.download.steps.2.content') }}</p>
        </div>
        <div>
            <h1>{{ trans('home.download.steps.3.name') }}</h1>
            <p>{{ trans('home.download.steps.3.content') }}</p>
        </div>
    </div>

    <div class="osu-layout__row osu-layout__row--page" id="download-guides">
        <div class="explanation">
            <h4>{{ trans('home.download.more') }}</h4>

            <p>
                {!! trans('home.download.more_text') !!}
            </p>
        </div>

        <div class="embed-responsive embed-responsive-16by9">
            <iframe src="https://www.youtube.com/embed/videoseries?list=PLmWVQsxi34bMYwAawZtzuptfMmszUa_tl" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
@stop
