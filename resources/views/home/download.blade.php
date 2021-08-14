{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
@component('layout._page_header_v4', ['params' => [
    'showTitle' => false,
    'theme' => 'download',
]])
    @slot('contentAppend')
        <div class="download-page-header">
            <span class="download-page-header__tagline">{!! osu_trans('home.download.tagline') !!}</span>

            <div class="download-page-header__icon">
                <i class="fas fa-download" aria-hidden="true"></i>
            </div>

            <a class="btn-osu-big btn-osu-big--download-page" href="{{ config('osu.urls.installer') }}">
                <span class="btn-osu-big__text-top">{{ osu_trans('home.download.action') }}</span>
                <span class="btn-osu-big__text-bottom">{{ osu_trans('home.download.os.windows') }}</span>
            </a>

            <p class="download-page-header__text">
                <a class="download-page-header__extra-link" href="{{ config('osu.urls.installer-mirror') }}">
                    {{ osu_trans('home.download.mirror') }}
                </a>
                &middot;
                <a class="download-page-header__extra-link" href="{{ config('osu.urls.osx') }}">
                    {{ osu_trans('home.download.macos-fallback') }}
                </a>
            </p>
        </div>
    @endslot
@endcomponent
<div class="osu-page osu-page--download">
    <div class="download-page">
        <div class="download-page__step">
            <div class="download-page__text download-page__text--title">
                <span class="download-page__step-number">1</span>
                {{ osu_trans("home.download.steps.download.title") }}
            </div>
            <div class="download-page__text download-page__text--description">
                {{ osu_trans("home.download.steps.download.description") }}
            </div>
        </div>
        <div class="download-page__step">
            <div class="download-page__text download-page__text--title">
                <span class="download-page__step-number">2</span>
                {{ osu_trans('home.download.steps.register.title') }}
            </div>
            <div class="download-page__text download-page__text--description">
                {{ osu_trans('home.download.steps.register.description') }}
            </div>
        </div>
        <div class="download-page__step">
            <div class="download-page__text download-page__text--title">
                <span class="download-page__step-number">3</span>
                {{ osu_trans("home.download.steps.beatmaps.title") }}
            </div>
            <div class="download-page__text download-page__text--description">
                {!! osu_trans('home.download.steps.beatmaps.description._', [
                    'browse' => tag(
                        'a',
                        ['href' => route('beatmapsets.index')],
                        osu_trans('home.download.steps.beatmaps.description.browse')
                    )
                ]) !!}
            </div>
        </div>

        @if (config('services.enchant.id') !== null)
            <div class="download-page__help">
                {!! osu_trans('home.download.help._', [
                    'support_button' => tag('a', [
                        'class' => 'js-enchant--show',
                        'role' => 'button',
                        'href' => '#',
                    ], osu_trans('home.download.help.support_button')),
                    'help_forum_link' => tag('a', [
                        'href' => route('forum.forums.show', ['forum' => config('osu.forum.help_forum_id')]),
                    ], osu_trans('home.download.help.help_forum_link')),
                ]) !!}
            </div>

            @include('objects._enchant')
        @endif
    </div>
</div>

<div class="osu-page osu-page--download">
    <div class="download-page-video">
        <div class="download-page-video__title">
            {{ osu_trans('home.download.video-guide') }}
        </div>

        <div class="download-page-video__embed">
            <iframe
                src="https://youtube.com/embed/videoseries?list={{ config('osu.urls.youtube-tutorial-playlist') }}"
            ></iframe>
        </div>
    </div>
</div>
@endsection
