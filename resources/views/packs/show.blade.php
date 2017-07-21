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
        <ul class="beatmap-pack-download__list">
            @foreach ($pack->downloadUrls() as $download)
                <li>
                    <a href="{{ $download['url'] }}"
                        class="beatmap-pack-download__link">{{ trans('beatmappacks.show.download') }}</a> {{ $download['host'] }}
            @endforeach
        </ul>
    @else
        @php
            $title = trans('users.anonymous.login_link');
            $text = trans('beatmappacks.require_login.link_text');
            $link = Html::link('#', $text, ['class' => 'js-user-link', 'title' => $title]);
        @endphp
        {!! trans('beatmappacks.require_login._', ['link' => $link]) !!}
    @endif
</div>
<ul class="beatmap-pack-items">
    @foreach ($sets as $set)
        <li class="beatmap-pack-items__set {{ $set->count > 0 ? 'beatmap-pack-items__set--cleared' : '' }}">
            <a href="{{ route('beatmapsets.show', ['beatmapset' => $set->getKey()]) }}" class="beatmap-pack-items__link">
                <span class="beatmap-pack-items__artist">{{ $set->artist }}</span>
                <span class="beatmap-pack-items__title"> - {{ $set->title }}</span>
            </a>
            <span class="beatmap-pack-items__title"> - {{ $set->count }}</span>
    @endforeach
</ul>
