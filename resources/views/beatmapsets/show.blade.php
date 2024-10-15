{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if (optional(Auth::user())->isAdmin())
    @php
        $extraFooterLinks = [
            osu_trans('common.buttons.admin') => route('admin.beatmapsets.show', $beatmapset->getKey()),
        ];
    @endphp
@endif
@extends('master', [
    'titlePrepend' => "{$beatmapset->getDisplayArtist(auth()->user())} - {$beatmapset->getDisplayTitle(auth()->user())}",
    'extraFooterLinks' => $extraFooterLinks ?? [],
])

@section('content')
    <div class="js-react--beatmapset-page u-contents"></div>
    @if (Auth::user()?->isModerator() ?? false)
        <div class="admin-menu">
            <button class="admin-menu__button js-menu" data-menu-target="admin-beatmapset" type="button">
                <span class="fas fa-angle-up"></span>
                <span class="admin-menu__button-icon fas fa-tools"></span>
            </button>
            <div class="admin-menu__menu js-menu" data-menu-id="admin-beatmapset" data-visibility="hidden">
                <a class="admin-menu-item" href="{{ $beatmapset->coverURL('raw') }}" target="_blank">
                    <span class="admin-menu-item__content">
                        <span class="admin-menu-item__label admin-menu-item__label--icon">
                            <span class="fas fa-image"></span>
                        </span>

                        <span class="admin-menu-item__label admin-menu-item__label--text">
                            {{ osu_trans('beatmapsets.show.admin.full_size_cover') }}
                        </span>
                    </span>
                </a>
            </div>
        </div>
    @endif
@endsection

@section("script")
    @parent

    <script id="json-beatmapset" type="application/json">
        {!! json_encode($set) !!}
    </script>

    <script id="json-comments" type="application/json">
        {!! json_encode($commentBundle->toArray()) !!}
    </script>

    <script id="json-genres" type="application/json">
        {!! json_encode($genres) !!}
    </script>

    <script id="json-languages" type="application/json">
        {!! json_encode($languages) !!}
    </script>

    @include('beatmapsets._recommended_star_difficulty_all')
    @include('layout._react_js', ['src' => 'js/beatmapsets-show.js'])
@endsection
