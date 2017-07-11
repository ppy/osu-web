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
@extends("master", [
  'current_section' => 'beatmappacks',
  'current_action' => 'index',
  'title' => trans('beatmappacks.index.title'),
  'pageDescription' => trans('beatmappacks.index.title'),
])

@section("content")
  <div class="beatmap-packs">
    <ul class="beatmap-packs__filters">
      <li class="beatmap-packs__filter"><a href="{{ route('beatmappacks.index', ['t' => 's']) }}">Standard</a>
      <li class="beatmap-packs__filter"><a href="{{ route('beatmappacks.index', ['t' => 'r']) }}">Chart</a>
      <li class="beatmap-packs__filter"><a href="{{ route('beatmappacks.index', ['t' => 't']) }}">Theme</a>
      <li class="beatmap-packs__filter"><a href="{{ route('beatmappacks.index', ['t' => 'a']) }}">Artist/Album</a>
    </ul>
    @foreach ($packs as $pack)
      <div class="js-beatmap-pack beatmap-pack" data-pack-id="{{ $pack['pack_id'] }}">
        <a class="js-beatmap-pack-link beatmap-pack__link" data-pack-id="{{ $pack['pack_id'] }}"
          href="#">{{ $pack['name'] }}
        </a>
        <span class="beatmap-pack__date">{{ $pack['date'] }}</span>
        <span class="beatmap-pack__author">{{ $pack['author'] }}</span>
        <div class="js-beatmap-pack__items js-beatmap-pack__items--collapsed beatmap-pack__items"></div>
        {{-- @include('beatmappacks._items', ['items' =>$pack->items()->get()]) --}}
      </div>
    @endforeach
  </div>
@endsection
