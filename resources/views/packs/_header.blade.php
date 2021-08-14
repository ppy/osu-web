{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $links = [
        [
            'title' => osu_trans('beatmappacks.index.nav_title'),
            'url' => route('packs.index'),
        ],
    ];

    if (isset($pack)) {
        $links[] = [
            'title' => $pack->name,
            'url' => route('packs.show', $pack),
        ];
    }
@endphp

@include('layout._page_header_v4', ['params' => [
    'links' => $links,
    'linksBreadcrumb' => true,
    'theme' => 'beatmappacks',
]])

<div class="osu-page">
    <div class="beatmap-packs-header">
        @php
            $scaryTexts = [
                tag('span', ['class' => 'beatmap-packs-header__scary'], osu_trans('beatmappacks.index.blurb.instruction.scary')),
                tag('span', ['class' => 'beatmap-packs-header__scary'], osu_trans('beatmappacks.index.blurb.note.scary')),
            ];
        @endphp
        <p class="beatmap-packs-header__important">{{ osu_trans('beatmappacks.index.blurb.important') }}</p>
        <p>{!! osu_trans('beatmappacks.index.blurb.instruction._', ['scary' => $scaryTexts[0]]) !!}</p>
        <p>{!! osu_trans('beatmappacks.index.blurb.note._', ['scary' => $scaryTexts[1]]) !!}</p>
    </div>
</div>
