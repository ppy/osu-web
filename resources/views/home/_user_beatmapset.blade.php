{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<a class='user-home-beatmapset' href="{{route('beatmapsets.show', $beatmapset->beatmapset_id)}}">
    <img class='user-home-beatmapset__cover'
        src="{{$beatmapset->allCoverURLs()['list']}}"
        srcSet="{{$beatmapset->allCoverURLs()['list']}} 1x, {{$beatmapset->allCoverURLs()['list@2x']}} 2x">

    <div class="user-home-beatmapset__meta">
        <div class='user-home-beatmapset__title u-ellipsis-overflow'>{{$beatmapset->title}}</div>
        <div class='user-home-beatmapset__artist u-ellipsis-overflow'>{{$beatmapset->artist}}</div>
        <div class='user-home-beatmapset__creator u-ellipsis-overflow'>
            {!! trans('home.user.beatmaps.by_user', ['user' => tag(
                'span',
                ['data-user-id' => $beatmapset->user_id, 'class' => 'js-usercard'],
                e($beatmapset->creator)
            )]) !!}

            <span class='user-home-beatmapset__playcount'>
                @if ($type === 'new')
                    {!! timeago($beatmapset->approved_date) !!}
                @elseif ($type === 'popular')
                    <span class="fa fa-heart"></span>
                    {{ i18n_number_format($beatmapset->favourite_count) }}
            @endif
            </span>
        </div>
    </div>
    <div class='user-home-beatmapset__chevron'><i class='fas fa-chevron-right'></i></div>
</a>
