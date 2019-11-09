{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    <div class="osu-layout__row osu-layout__row--page-compact">
        <div class="osu-page-header osu-page-header--live">
                <h1 class="osu-page-header__title">{{ trans('livestreams.top-headers.headline') }}</h1>

                <p class="osu-page-header__title osu-page-header__title--smaller">
                    {!! trans('livestreams.top-headers.description', [
                    'link' => link_to(
                    wiki_url('Guides/Live_Streaming_osu!'),
                    trans('livestreams.top-headers.link'),
                    ['class' => 'osu-page-header__description-link']
                    ),
                    ]) !!}
                </p>
        </div>
    </div>

    @if ($featuredStream !== null)
        <div class="osu-layout__row osu-layout__row--page-compact">
            @include('livestreams._featured', compact('featuredStream'))
        </div>
    @endif

    <div class="osu-layout__row osu-layout__row--page-compact">
        <div class="livestream-page">
            <h2 class="livestream-page__header">
                {{ trans('livestreams.headers.regular') }}
            </h2>

            <div class="livestream-page__items">
                @foreach ($streams as $stream)
                    <div class="livestream-page__item">
                        @include('livestreams._livestream', compact('stream'))
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
