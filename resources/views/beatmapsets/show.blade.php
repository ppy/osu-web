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
    'currentSection' => 'beatmaps',
    'pageDescription' => $beatmapset->toMetaDescription(),
    'titlePrepend' => "{$beatmapset->artist} - {$beatmapset->title}",
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

    <script id="json-countries" type="application/json">
        {!! json_encode($countries) !!}
    </script>

    <script id="json-comments-beatmapset-{{ $beatmapset->getKey() }}" type="application/json">
        {!! json_encode($commentBundle->toArray()) !!}
    </script>

    @include('layout._extra_js', ['src' => 'js/react/beatmapset-page.js'])
@endsection
