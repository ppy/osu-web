{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use Ds\Set;

    $currentUser = Auth::user();
    $userCompletedBeatmapIds = new Set($userCompletionData['beatmapset_ids']);
@endphp
<div class="beatmap-pack-description">
    @if($currentUser === null)
        {!! require_login('beatmappacks.require_login._', 'beatmappacks.require_login.link_text') !!}
    @else
        <a
            href="{{ $pack->url }}"
            class="beatmap-pack-download__link"
        >
            {{ osu_trans('beatmappacks.show.download') }}
        </a>
    @endif
</div>
@if ($pack->no_diff_reduction)
    <div class="beatmap-pack-description">
        {!! osu_trans('beatmappacks.show.no_diff_reduction._', [
            'link' => tag('a', ['href' => wiki_url('Game_modifier')], osu_trans('beatmappacks.show.no_diff_reduction.link')),
        ]) !!}
    </div>
@endif
<ul class="beatmap-pack-items">
    @foreach ($sets as $set)
        @php
            $cleared = $userCompletedBeatmapIds->contains($set->getKey());
            $iconClass = class_with_modifiers('beatmap-pack-items__icon', ['cleared' => $cleared]);
        @endphp
        <li class="beatmap-pack-items__set">
            <span class="fal fa-extra-mode-{{ $mode }} {{ $iconClass }}"
                  title="{{ $cleared ? osu_trans('beatmappacks.show.item.cleared') : osu_trans('beatmappacks.show.item.not_cleared') }}"
            ></span>
            <a href="{{ route('beatmapsets.show', ['beatmapset' => $set->getKey()]) }}" class="beatmap-pack-items__link">
                <span class="beatmap-pack-items__artist">{{ $set->getDisplayArtist($currentUser) }}</span>
                <span class="beatmap-pack-items__title"> - {{ $set->getDisplayTitle($currentUser) }}</span>
            </a>
    @endforeach
</ul>
