{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
@component('layout._page_header_v4')
@endcomponent

<div class="osu-page osu-page--generic-compact">
    <div class="download-page-header">
        <h2 class="download-page-header__tagline">{{ strtr(osu_trans('home.download.tagline'), ['<br>' => ' ']) }}</h2>

        <div class="download-page-header__choices">
            <div class="download-page-header__choice">
                <div class="download-page-header__action-description">
                    <h3 class="download-page-header__action-title">
                        {{ osu_trans('home.download.action_title') }}
                    </h3>
                </div>

                <div>
                    <a class="btn-osu-big btn-osu-big--download" href="{{ config('osu.urls.installer') }}">
                        <span class="btn-osu-big__text-top">{{ osu_trans('home.download.action') }}</span>
                        <span class="btn-osu-big__text-bottom">{{ osu_trans('home.download.os.windows') }}</span>
                    </a>

                    <div class="download-page-header__extra-links">
                        <a class="download-page-header__extra-link" href="{{ config('osu.urls.installer-mirror') }}">
                            {{ osu_trans('home.download.mirror') }}
                        </a>
                        <span class="download-page-header__extra-link download-page-header__extra-link--separator"></span>
                        <a class="download-page-header__extra-link" href="{{ config('osu.urls.osx') }}">
                            {{ osu_trans('home.download.macos-fallback') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="download-page-header__separator">{{ osu_trans('home.download.or') }}</div>
            <div class="download-page-header__choice">
                <div class="download-page-header__action-description">
                    <h3 class="download-page-header__action-title">
                        {{ osu_trans('home.download.action_lazer_title') }}
                    </h3>

                    <div>
                        <div>
                            {{ osu_trans('home.download.action_lazer_description') }}
                        </div>
                        @if (($lazerInfoUrl = config('osu.urls.lazer_info')) !== null)
                            <a href="{{ $lazerInfoUrl }}">
                                {{ osu_trans('home.download.action_lazer_info') }}
                            </a>
                        @endif
                    </div>
                </div>
                <div>
                    <a
                        class="btn-osu-big btn-osu-big--download btn-osu-big--download-lazer"
                        href="{{ $lazerUrl }}"
                    >
                        <span class="btn-osu-big__text-top">
                            {{ osu_trans('home.download.action_lazer') }}
                        </span>
                        <span class="btn-osu-big__text-bottom">
                            {{ osu_trans('home.download.for_os', ['os' => $lazerPlatformName]) }}
                        </span>
                    </a>

                    <div class="download-page-header__extra-links">
                        <a class="download-page-header__extra-link" href="{{ config('osu.urls.lazer_dl_other') }}">
                            {{ osu_trans('home.download.other_os') }}
                        </a>
                    </div>
                </div>
                <div class="download-page-header__note">
                    {{ osu_trans('home.download.lazer_note') }}
                </div>
            </div>
        </div>
    </div>
    <div class="user-profile-pages user-profile-pages--no-tabs">
        <div class="page-extra">
            <h2 class="title title--page-extra">
                {{ osu_trans('home.download.quick_start_guide') }}
            </h2>
            <div class="download-page">
                <div class="download-page__steps">
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

        <div class="page-extra">
            <h2 class="title title--page-extra">
                {{ osu_trans('home.download.video-guide') }}
            </h2>
            <div class="download-page-video">
                <iframe
                    src="https://youtube.com/embed/videoseries?list={{ config('osu.urls.youtube-tutorial-playlist') }}"
                ></iframe>
            </div>
        </div>
    </div>
</div>
@endsection
