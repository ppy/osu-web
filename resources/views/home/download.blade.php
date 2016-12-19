{{--
    Copyright 2015 ppy Pty. Ltd.

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
        <p>{{ trans('home.download.title.1') }}</p>
        <p>{{ trans('home.download.title.2') }}</p>
        <p>{{ trans('home.download.title.3') }}</p>
    </div>

    <div class="osu-layout__row" id="download-button">
        <a href="http://m1.ppy.sh/r/osu!install.exe">
            <img class="round" src="/images/download-button.png" alt="{{ trans('home.download.img_alt') }}" />
        </a>
    </div>

    <div class="osu-layout__row osu-layout__row--page" id="download-steps">
        <div>
            <h1>{{ trans('home.download.steps.1_title') }}</h1>
            <p>{{ trans('home.download.steps.1') }}</p>
        </div>
        <div>
            <h1>{{ trans('home.download.steps.2_title') }}</h1>
            <p>{{ trans('home.download.steps.2') }}</p>
        </div>
        <div>
            <h1>{{ trans('home.download.steps.3_title') }}</h1>
            <p>{{ trans('home.download.steps.3') }}</p>
        </div>
    </div>

    <div class="osu-layout__row osu-layout__row--page" id="download-guides">
        <div class="explanation">
            <h4>{{ trans('home.download.learn_more.title') }}</h4>

            <p>
                {{ trans('home.download.learn_more.text') }}
            </p>
        </div>

        <div class="embed-responsive embed-responsive-16by9">
            <iframe src="https://www.youtube.com/embed/videoseries?list=PLmWVQsxi34bMYwAawZtzuptfMmszUa_tl" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
@stop
