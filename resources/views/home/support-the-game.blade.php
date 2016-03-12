{{--
    Copyright 2015 ppy Pty. Ltd.

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
@extends("master")
@section("content")
<div class="community-support osu-layout__row">

  <div class="header">
    <!-- header info -->
    <div class="info">
      <h2 class="big-desc">{!! trans('community.support.header.big_description') !!}</h2>
      <p class="small-desc">{!! trans('community.support.header.small_description') !!}</p>

      <a class="shadow shadow--hover button" href="{{ config('osu.urls.support-the-game') }}">
        {!! trans('community.support.header.support_button') !!}&nbsp;&nbsp;<span class="fa fa-heart"></span>
      </a>
    </div><!-- end: header info -->
  </div>

  <!-- quote -->
  <div class="osu-layout__row osu-layout__row--page-compact page-container under-parent">
      <p><span class="fa fa-quote-left fa-5x"></span>&nbsp;&nbsp;&nbsp;“{!! trans('community.support.dev_quote') !!}”</p>
      <strong style="float: right;">— Dean “peppy” Herbert</strong>
      <br/>
  </div>
  <!-- end: quote -->

  <!-- ----------- -->
  <!-- why support -->
  <!-- ----------- -->
  <div class="osu-layout__row osu-layout__row--page-compact page-container">
    <h2 class="text-center">{{ trans('community.support.why_support.title') }}</h3>
    <br/><br/>

    <div class="perk-row text-center">
      @foreach($data['blocks'] as $name => $icon)
        <div class="perk">

          <div class="perk__container perk__container--blue">
            <div class="header">
              <span class="shadow-before fa fa-{{ $icon }} fa-4x"></span>
            </div>
            <div class="text">
              <p>{!! trans('community.support.why_support.blocks.'.$name) !!}</p>
            </div>

          </div>
        </div>
      @endforeach
    </div>
  </div>
  <!-- end: why support -->


  <!-- --------- -->
  <!-- what gets -->
  <!-- --------- -->
  <div class="osu-layout__row osu-layout__row--page-compact page-container">
    <h2 class="text-center">{{ trans('community.support.perks.title') }}</h3>
    <br/><br/>

    <!-- preview -->
    <div class="community-support__preview"></div>
    <br/><br/>

    <div class="perk-row text-center">
      @foreach($data['perks'] as $name => $icon)
        @if (strlen($name) > 0)
        <div class="perk">
          <div class="perk__container perk__container--green">

            <div class="header">
              <span class="shadow-before fa fa-{{ $icon }} fa-4x"></span>
            </div>
            <div class="text">
              <h3>{!! trans('community.support.perks.'.$name.'.title') !!}</h3>
              {!! trans('community.support.perks.'.$name.'.description') !!}
            </div>

          </div>
        </div>
        @endif
      @endforeach
    </div>
  </div>
  <!-- end: what gets -->

  <!-- convinced -->
  <div class="osu-layout__row osu-layout__row--page-compact page-container convinced text-center">
    <h2>{{ trans('community.support.convinced.title') }}</h2>
    <br/><br/>

    <a class="convinced__heart link--white" href="{{ config('osu.urls.support-the-game') }}">
      <div class="convinced__heart__inner">
        <i class="fa fa-heart fa-5x"></i>
      </div>
    </a>

    <h3>{{ trans('community.support.convinced.support') }}</h3>
    <h4 class="first">{{ trans('community.support.convinced.gift') }}</h4>
    <h4 class="last">{{ trans('community.support.convinced.instructions') }}</h4>
  </div>
  <!-- end: convinced -->

</div>
@stop
