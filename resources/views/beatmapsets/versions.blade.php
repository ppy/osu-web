{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'pageDescription' => osu_trans('beatmapsets.index.title'),
])

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'links' => [
            [
                'title' => osu_trans('layout.header.beatmapsets.show'),
                'url' => route('beatmapsets.show', $beatmapset),
            ],
            [
                'title' => osu_trans('layout.header.beatmapsets.discussions'),
                'url' => route('beatmapsets.discussion', $beatmapset),
            ],
            [
                'active' => true,
                'count' => count($versions),
                'title' => osu_trans('layout.header.beatmapsets.versions'),
                'url' => route('beatmapsets.versions', $beatmapset),
            ],
        ],
        'theme' => 'beatmapset',
    ]])

    <div class="osu-page osu-page--beatmapset">
        <ul class="beatmapset-versions">
            @foreach ($versions->values() as $i => $version)
                @php
                    $versionNumber = count($versions) - $i;
                    $versionAnchor = "version-{$versionNumber}";
                @endphp
                <li class="beatmapset-versions__entry" id="{{ $versionAnchor }}">
                    <a href="#{{ $versionAnchor }}" class="beatmapset-versions__number">
                        Version <strong>{{ $versionNumber }}</strong>
                    </a>
                    <span>{!! timeago($version->created_at) !!}</span>
                    @php
                        $changes = $version->changes();
                    @endphp
                    <ul class="beatmapset-versions__changes">
                        @foreach ($changes['added'] as $versionFile)
                            <li>
                                <a
                                    class="beatmapset-versions__change"
                                    download
                                    href="{{ route('beatmapset-version-files.download', $versionFile->getKey()) }}"
                                >
                                    <span class="beatmapset-versions__icon beatmapset-versions__icon--added">
                                        <span class="svg-icon svg-icon--plus"></span>
                                    </span>
                                    <span>{{ $versionFile->filename }}</span>
                                </a>
                        @endforeach
                        @foreach ($changes['updated'] as $versionFile)
                            <li>
                                <a
                                    class="beatmapset-versions__change"
                                    download
                                    href="{{ route('beatmapset-version-files.download', $versionFile->getKey()) }}"
                                >
                                    <span class="beatmapset-versions__icon beatmapset-versions__icon--updated">
                                        <span class="svg-icon svg-icon--arrow-cycle"></span>
                                    </span>
                                    <span>{{ $versionFile->filename }}</span>
                                </a>
                        @endforeach
                        @foreach ($changes['removed'] as $versionFile)
                            <li>
                                <span class="beatmapset-versions__change">
                                    <span class="beatmapset-versions__icon beatmapset-versions__icon--removed">
                                        <span class="svg-icon svg-icon--trash"></span>
                                    </span>
                                    <del>{{ $versionFile->filename }}</del>
                                </span>
                        @endforeach
                    </ul>
            @endforeach
        </ul>
    </div>
@endsection
