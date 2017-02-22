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

<div class='user-home-beatmap-list'>
    <h3 class='user-home-beatmap-list__heading'>{{$heading}}</h3>
    @foreach ($beatmaps as $beatmap)
        @if ($loop->iteration > $num_shown)
            @break;
        @endif
        <a class='user-home-beatmap-list__beatmap' href="{{route('beatmapsets.show', $beatmap->beatmapset_id)}}">
            <div class='user-home-beatmap-list__cover' style="background-image: url({{$beatmap->allCoverURLs()['list']}});"></div>
            <div class="user-home-beatmap-list__meta">
                <div class='user-home-beatmap-list__title u-ellipsis-overflow'>{{$beatmap->title}}</div>
                <div class='user-home-beatmap-list__artist u-ellipsis-overflow'>{{$beatmap->artist}}</div>
                <div class='user-home-beatmap-list__creator u-ellipsis-overflow'>
                    by {{$beatmap->creator}}, <span class='user-home-beatmap-list__playcount'>{{number_format($beatmap->play_count)}} plays</span>
                </div>
            </div>
            <div class='user-home-beatmap-list__chevron'><i class='fa fa-fw fa-chevron-right'></i></div>
        </a>
    @endforeach
</div>
