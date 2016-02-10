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
  <div class="help-support osu-layout__row">
    <div id="help_support_header" class="header">

      <!-- header info -->
      <div class="info">
        <h2 class="big-desc">{!! trans('help.support.header.big_description') !!}</h2>
        <p class="small-desc">{!! trans('help.support.header.small_description') !!}</p>

        <a class="shadow hover button" href="">{!! trans('help.support.header.support_button') !!}&nbsp;&nbsp;<span class="fa fa-heart"></span></a>
      </div><!-- end: header info -->

      <img class="bg" src="../images/headers/help-support.png" alt="support osu!">
    </div> <!-- end: header -->

    <!-- quote -->
    <div class="osu-layout__row osu-layout__row--page-compact page-container under-parent">
        <p><span class="fa fa-quote-left fa-5x"></span>&nbsp;&nbsp;&nbsp;“{!! trans('help.support.dev_quote') !!}”</p>
        <strong style="float: right;">— Dean “peppy” Herbert</strong>
        <br/>
    </div>
    <!-- end: quote -->

    <!-- ----------- -->
    <!-- why support -->
    <!-- ----------- -->
    <div class="osu-layout__row osu-layout__row--page-compact page-container">
      <h2 class="text-center">{{ trans('help.support.why_support.title') }}</h3>
      <br/><br/>

      <div class="row text-center">
        @foreach($data['blocks'] as $name => $icon)
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 perk">

            <div class="perk-container blue">
              <div class="header">
                <span class="shadow-before fa fa-{{ $icon }} fa-4x"></span>
              </div>
              <div class="text">
                <p>{!! trans('help.support.why_support.blocks.'.$name) !!}</p>
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
      <h2 class="text-center">{{ trans('help.support.perks.title') }}</h3>
      <br/><br/>

      <!-- preview -->
      <img class="img-responsive" src="../images/headers/help-support-preview.png" alt="supporter preview">
      <br/><br/>
      
      <div class="row text-center">
        @foreach($data['perks'] as $name => $icon)
          @if (strlen($name) > 0)
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 perk">
            <div class="perk-container green">

              <div class="header">
                <span class="shadow-before fa fa-{{ $icon }} fa-4x"></span>
              </div>
              <div class="text">
                <h3>{!! trans('help.support.perks.'.$name.'.title') !!}</h3>
                {!! trans('help.support.perks.'.$name.'.description') !!}
              </div>

            </div>
          </div>
          @else
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3"></div>
          @endif
        @endforeach
      </div>
    </div>
    <!-- end: what gets -->

    <!-- convinced -->
    <div class="osu-layout__row osu-layout__row--page-compact page-container convinced text-center">
      <h2>{{ trans('help.support.convinced.title') }}</h2>
      <br/><br/>

      <div class="heart" href="">
        <div class="inner">
          <span class="fa fa-heart fa-5x"></span>
        </div>
      </div>

      <h3>{{ trans('help.support.convinced.support') }}</h3>
      <h4 class="first">{{ trans('help.support.convinced.gift') }}</h4>
      <h4 class="last">{{ trans('help.support.convinced.instructions') }}</h4>
    </div>
    <!-- end: convinced -->

  </div>
<script>
$(document).ready(function() {
  var hsbg = $("#help_support_header img.bg");
  var h = $(".help-support > .header");

  // resize the header image's height so things don't get behind it
  var fixHeight = function() {
    h.css('height', hsbg.height());
  };

  fixHeight();
  $(window).on('resize', function() {
    fixHeight();
  });
});
</script>
@stop