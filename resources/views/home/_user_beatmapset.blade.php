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

<a class='user-home-beatmapset' href="{{route('beatmapsets.show', $beatmapset->beatmapset_id)}}">
    <img class='user-home-beatmapset__cover'
        src="{{$beatmapset->allCoverURLs()['list']}}"
        srcSet="{{$beatmapset->allCoverURLs()['list']}} 1x, {{$beatmapset->allCoverURLs()['list@2x']}} 2x">

    <div class="user-home-beatmapset__meta">
        <div class='user-home-beatmapset__title u-ellipsis-overflow'>{{$beatmapset->title}}</div>
        <div class='user-home-beatmapset__artist u-ellipsis-overflow'>{{$beatmapset->artist}}</div>
        <div class='user-home-beatmapset__creator u-ellipsis-overflow'>
            @if ($type === 'new')
                by {{$beatmapset->creator}}, <span class='user-home-beatmapset__playcount'>{!! timeago($beatmapset->approved_date) !!}</span>
            @elseif ($type === 'popular')
                by {{$beatmapset->creator}}, <span class='user-home-beatmapset__playcount'>{{number_format($popularBeatmapsetsPlaycount[$beatmapset->beatmapset_id])}} plays</span>
            @endif
        </div>
    </div>
    <div class='user-home-beatmapset__chevron'><i class='fa fa-fw fa-chevron-right'></i></div>
</a>
