{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
<div class="osu-page osu-page--header">
    <div class="osu-page-header-v2 osu-page-header-v2--download">
        <div class="download-page-header">
            <span class="download-page-header__tagline">{!! trans('home.download.tagline') !!}</span>

            <div class="download-page-header__icon">
                <i class="fas fa-download" aria-hidden="true"></i>
            </div>

            <a class="btn-osu-big btn-osu-big--download-page" href="{{ config('osu.urls.installer') }}">
                <span class="btn-osu-big__text-top">{{ trans('home.download.action') }}</span>
                <span class="btn-osu-big__text-bottom">{{ trans('home.download.os.windows') }}</span>
            </a>

            <p class="download-page-header__text">
                <a class="download-page-header__extra-link" href="{{ config('osu.urls.installer-mirror') }}">
                    {{ trans('home.download.mirror') }}
                </a>
                &middot;
                <a class="download-page-header__extra-link" href="{{ config('osu.urls.osx') }}">
                    {{ trans('home.download.macos-fallback') }}
                </a>
            </p>
        </div>
    </div>
</div>

<div class="osu-page osu-page--download">
    <div class="download-page">
        <div class="download-page__step">
            <div class="download-page__text download-page__text--title">
                <span class="download-page__step-number">1</span>
                {{ trans("home.download.steps.download.title") }}
            </div>
            <div class="download-page__text download-page__text--description">
                {{ trans("home.download.steps.download.description") }}
            </div>
        </div>
        <div class="download-page__step">
            <div class="download-page__text download-page__text--title">
                <span class="download-page__step-number">2</span>
                {{ trans('home.download.steps.register.title') }}
            </div>
            <div class="download-page__text download-page__text--description">
                {{ trans('home.download.steps.register.description') }}
            </div>
        </div>
        <div class="download-page__step">
            <div class="download-page__text download-page__text--title">
                <span class="download-page__step-number">3</span>
                {{ trans("home.download.steps.beatmaps.title") }}
            </div>
            <div class="download-page__text download-page__text--description">
                {!! trans('home.download.steps.beatmaps.description._', [
                    'browse' =>
                        '<a class="download-page__link" href="'.e(route('beatmapsets.index')).'" >'.
                        trans('home.download.steps.beatmaps.description.browse').
                        '</a>',
                ]) !!}
            </div>
        </div>
        <div class="download-page__accent"></div>
    </div>
</div>

<div class="osu-page osu-page--download">
    <div class="download-page-video">
        <div class="download-page-video__title">
            {{ trans('home.download.video-guide') }}
        </div>

        <div class="download-page-video__embed">
            <iframe
                src="https://youtube.com/embed/videoseries?list={{ config('osu.urls.youtube-tutorial-playlist') }}"
            ></iframe>
        </div>
    </div>
</div>
@endsection
