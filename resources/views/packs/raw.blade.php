{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}


<div class="beatmap-pack-description">
    @if(Auth::check())
        <a href="{{ $pack->url }}"
            class="beatmap-pack-download__link">{{ trans('beatmappacks.show.download') }}</a>
    @else
        {!! require_login('beatmappacks.require_login._', 'beatmappacks.require_login.link_text') !!}
    @endif
</div>
@if ($pack->no_diff_reduction)
    <div class="beatmap-pack-description">
        {!! trans('beatmappacks.show.no_diff_reduction._', [
            'link' => tag('a', ['href' => wiki_url('Game_modifier')], trans('beatmappacks.show.no_diff_reduction.link')),
        ]) !!}
    </div>
@endif
<ul class="beatmap-pack-items">
    @foreach ($sets as $set)
        @php
            $cleared = in_array($set->getKey(), $userCompletionData['beatmapset_ids'], true)
        @endphp
        <li class="beatmap-pack-items__set">
            <span class="fal fa-extra-mode-{{$mode}} beatmap-pack-items__icon {{ $cleared ? 'beatmap-pack-items__icon--cleared' : '' }}"
                  title="{{ $cleared ? trans('beatmappacks.show.item.cleared') : trans('beatmappacks.show.item.not_cleared') }}"
            ></span>
            <a href="{{ route('beatmapsets.show', ['beatmapset' => $set->getKey()]) }}" class="beatmap-pack-items__link">
                <span class="beatmap-pack-items__artist">{{ $set->getDisplayArtist(auth()->user()) }}</span>
                <span class="beatmap-pack-items__title"> - {{ $set->getDisplayTitle(auth()->user()) }}</span>
            </a>
    @endforeach
</ul>
