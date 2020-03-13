{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}


<div class="beatmap-pack-download">
    @if(Auth::check())
        <a href="{{ $pack->downloadUrl()['url'] }}"
            class="beatmap-pack-download__link">{{ trans('beatmappacks.show.download') }}</a>
    @else
        {!! require_login('beatmappacks.require_login._', 'beatmappacks.require_login.link_text') !!}
    @endif
</div>
<ul class="beatmap-pack-items">
    @foreach ($sets as $set)
        <li class="beatmap-pack-items__set">
            <span class="fal fa-extra-mode-{{$mode}} beatmap-pack-items__icon {{ $set->count > 0 ? 'beatmap-pack-items__icon--cleared' : '' }}"
                  title="{{ $set->count > 0 ? trans('beatmappacks.show.item.cleared') : trans('beatmappacks.show.item.not_cleared') }}"
            ></span>
            <a href="{{ route('beatmapsets.show', ['beatmapset' => $set->getKey()]) }}" class="beatmap-pack-items__link">
                <span class="beatmap-pack-items__artist">{{ $set->artist }}</span>
                <span class="beatmap-pack-items__title"> - {{ $set->title }}</span>
            </a>
    @endforeach
</ul>
