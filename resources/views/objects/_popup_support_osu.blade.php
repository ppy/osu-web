{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

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
<div class='support-osu-popup'>
  <div class='support-osu-popup__content'>
      <div>
        <h1 class='support-osu-popup__header'>{{trans('home.support-osu.title')}}</h1>
        <h2 class='support-osu-popup__subtitle'>{{trans('home.support-osu.subtitle')}}</h2>
      </div>
      <div>{{trans('home.support-osu.body.part-1')}}</div>
      <video
          autoplay
          loop
          muted
          playsinline
          class='support-osu-popup__video'
          src='{{config('osu.support.video_url')}}'
      ></video>
      <div>{!!trans('home.support-osu.body.part-2')!!}</div>
      <hr class='support-osu-popup__divider'/>
      <a href='{{route('support-the-game')}}' class='btn-osu-big btn-osu-big--mega'>
        <div>
          {{trans('home.support-osu.find-out-more')}}
          <span class='fas fa-chevron-circle-right'></span>
        </div>
      </a>
      <div>{{trans('home.support-osu.download-starting')}}</div>
  </div>
  <div class='support-osu-popup__pippi'>
    <a href="{{route('support-the-game')}}" class='support-osu-popup__heart'></a>
  </div>
  <a href='#' class='support-osu-popup__close-button'><i class='fas fa-fw fa-times'></i></a>
</div>
