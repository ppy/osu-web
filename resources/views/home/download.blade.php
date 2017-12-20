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
<div class="osu-layout__row">
    <div class="osu-page-header-v2 osu-page-header-v2--download">
        <div class="download-page__header-content">
            <span class="download-page__tagline">{!! trans('home.download.tagline') !!}</span>

            <i class="fa fa-download download-page__icon" aria-hidden="true"></i>

            <a class="download-page__button btn-osu-big btn-osu-big--download-page" href="{{ config('osu.urls.installer') }}">
                <span class="btn-osu-big__text-top">{{ trans('home.download.action') }}</span>
                <span class="btn-osu-big__text-bottom">{{ trans('home.download.os.windows') }}</span>
            </a>

            <p class="download-page__header-text">
                <a href="{{ config('osu.urls.installer-mirror') }}">{{ trans('home.download.mirror') }}</a> -
                <a href="{{ config('osu.urls.osx') }}">{{ trans('home.download.macos-fallback') }}</a>
            </p>
        </div>
    </div>
</div>
<div class="osu-layout__row osu-layout__row--page-download">
    <div class="download-page__info">
        <div class="download-page__step">
            <div class="download-page__step-top">
                <span class="download-page__step-number">1</span>
                <span class="download-page__step-text">{{ trans("home.download.steps.download.title") }}</span>
            </div>
            <div class="download-page__step-bottom">
                <p class="download-page__step-text download-page__step-text--description">
                    {{ trans("home.download.steps.download.description") }}
                </p>
            </div>
        </div>
        <div class="download-page__step">
            <div class="download-page__step-top">
                <span class="download-page__step-number">2</span>
                <span class="download-page__step-text">{{ trans('home.download.steps.register.title') }}</span>
            </div>
            <div class="download-page__step-bottom">
                <p class="download-page__step-text download-page__step-text--description">
                    {{ trans('home.download.steps.register.description') }}
                </p>
            </div>
        </div>
        <div class="download-page__step">
            <div class="download-page__step-top">
                <span class="download-page__step-number">3</span>
                <span class="download-page__step-text">{{ trans("home.download.steps.beatmaps.title") }}</span>
            </div>
            <div class="download-page__step-bottom">
                <p class="download-page__step-text download-page__step-text--description">
                    <a
                        class="download-page__step-text download-page__step-text--description download-page__step-text--accent"
                        href="{{ action('BeatmapsetsController@index') }}"
                    >
                        {{ trans('home.download.steps.beatmaps.description-accent') }}
                    </a>
                    {{ trans("home.download.steps.beatmaps.description") }}
                </p>
            </div>
        </div>
    </div>
    <div class="download-page__accent"></div>
</div>
<div class="osu-layout__row osu-layout__row--page-download">
    <div class="download-page__video-header">{{ trans('home.download.video-guide') }}</div>
    <div class="download-page__video-embed">
        <iframe src="https://youtube.com/embed/videoseries?list={{ config('osu.urls.youtube-tutorial-playlist') }}" width="" height="350"></iframe>
    </div>
</div>
@endsection

