{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class='support-osu-popup'>
  <div class='support-osu-popup__content'>
      <div>
        <h1 class='support-osu-popup__header'>{{osu_trans('home.support-osu.title')}}</h1>
        <h2 class='support-osu-popup__subtitle'>{{osu_trans('home.support-osu.subtitle')}}</h2>
      </div>
      <div>{{osu_trans('home.support-osu.body.part-1')}}</div>
      <video
          autoplay
          loop
          muted
          playsinline
          class='support-osu-popup__video'
          src='{{config('osu.support.video_url')}}'
      ></video>
      <div>{!!osu_trans('home.support-osu.body.part-2')!!}</div>
      <hr class='support-osu-popup__divider'/>
      <a href='{{route('support-the-game')}}' class='btn-osu-big btn-osu-big--mega'>
        <div>
          {{osu_trans('home.support-osu.find-out-more')}}
          <span class='fas fa-chevron-circle-right'></span>
        </div>
      </a>
      <div>{{osu_trans('home.support-osu.download-starting')}}</div>
  </div>
  <div class='support-osu-popup__pippi'>
    <a href="{{route('support-the-game')}}" class='support-osu-popup__heart'></a>
  </div>
  <a href='#' class='support-osu-popup__close-button'><i class='fas fa-fw fa-times'></i></a>
</div>
