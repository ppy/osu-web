{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if (optional(Auth::user())->isAdmin())
    @php
        $extraFooterLinks = [
            trans('common.buttons.admin') => route('admin.beatmapsets.show', $beatmapset->getKey()),
        ];
    @endphp
@endif
@extends('master', [
    'pageDescription' => $beatmapset->toMetaDescription(),
    'titlePrepend' => "{$beatmapset->getDisplayArtist(auth()->user())} - {$beatmapset->getDisplayTitle(auth()->user())}",
    'extraFooterLinks' => $extraFooterLinks ?? [],
])

@section('content')
    <div class="js-react--beatmapset-page osu-layout osu-layout--full"></div>
@endsection

@section("script")
    @parent

    <script id="json-beatmapset" type="application/json">
        {!! json_encode($set) !!}
    </script>

    <script id="json-comments-beatmapset-{{ $beatmapset->getKey() }}" type="application/json">
        {!! json_encode($commentBundle->toArray()) !!}
    </script>

    <script id="json-genres" type="application/json">
        {!! json_encode($genres) !!}
    </script>

    <script id="json-languages" type="application/json">
        {!! json_encode($languages) !!}
    </script>

    @include('beatmapsets._recommended_star_difficulty_all')
    @include('layout._extra_js', ['src' => 'js/react/beatmapset-page.js'])
@endsection
