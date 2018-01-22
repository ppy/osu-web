{{--
    Copyright 2015-2017 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
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
            <span class="fa fa-extra-mode-{{$mode}} beatmap-pack-items__icon {{ $set->count > 0 ? 'beatmap-pack-items__icon--cleared' : '' }}"
                  title="{{ $set->count > 0 ? trans('beatmappacks.show.item.cleared') : trans('beatmappacks.show.item.not_cleared') }}"
            ></span>
            <a href="{{ route('beatmapsets.show', ['beatmapset' => $set->getKey()]) }}" class="beatmap-pack-items__link">
                <span class="beatmap-pack-items__artist">{{ $set->artist }}</span>
                <span class="beatmap-pack-items__title"> - {{ $set->title }}</span>
            </a>
    @endforeach
</ul>
