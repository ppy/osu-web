{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="beatmap-pack-item-header">
    <div>
        <span class="beatmap-pack-item-header__name">
            {{ $pack->name }}
        </span>
        @if ($pack->no_diff_reduction)
            <span class="beatmap-pack-item-header__badge">
                {{ osu_trans('beatmappacks.show.no_diff_reduction_badge') }}
            </span>
        @endif
    </div>
    <div class="beatmap-pack-item-header__details">
        <span class="beatmap-pack-item-header__date">{{ json_date($pack->date) }}</span>
        <span>{!! osu_trans('beatmappacks.show.created_by', ['author' => tag('strong', content: e($pack->author))]) !!}</span>
    </div>
</div>
