{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if ($contest->hasThumbnails())
    <div class="js-react--contestArtList" data-src="contest-{{$contest->id}}"></div>
@else
    <div class="js-react--contestList" data-src="contest-{{$contest->id}}"></div>
@endif
<script id="contest-{{$contest->id}}" type="application/json">
    {!! $contest->defaultJson(Auth::user()) !!}
</script>

@if ($contest->type === 'beatmap' && isset($contest->getExtraOptions()['beatmapset_dl']))
    <div class='contest__buttons'>
        <a class="btn-osu-big btn-osu-big--contest-download" href="{{$contest->getExtraOptions()['beatmapset_dl']}}">
            <div class="btn-osu-big__content">
                <div class="btn-osu-big__left"><span class="btn-osu-big__text-top">{{ osu_trans('contest.entry.download') }}</span></div>
                <span class="fas fa-download"></span>
            </div>
        </a>
    </div>
@endif
