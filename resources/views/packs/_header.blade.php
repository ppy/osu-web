{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<div class="osu-page-header osu-page-header--beatmappacks">
    <div class="beatmap-packs-header">
        <div class="beatmap-packs-header__header">
            <div class="beatmap-packs-header__icon"></div>
            <div class="beatmap-packs-header__title">{{trans('beatmappacks.index.title')}}</div>
        </div>
        <div class="beatmap-packs-header__blurb">
            @php
                $scaryTexts = [
                    '<span class="beatmap-packs-header__scary">' . trans('beatmappacks.index.blurb.instruction.scary') . '</span>',
                    '<span class="beatmap-packs-header__scary">' . trans('beatmappacks.index.blurb.note.scary') . '</span>',
                ];
            @endphp
            <p class="beatmap-packs-header__important">{{ trans('beatmappacks.index.blurb.important') }}</p>
            <p>{!! trans('beatmappacks.index.blurb.instruction._', ['scary' => $scaryTexts[0]]) !!}</p>
            <p>{!! trans('beatmappacks.index.blurb.note._', ['scary' => $scaryTexts[1]]) !!}</p>
        </div>
    </div>
</div>
