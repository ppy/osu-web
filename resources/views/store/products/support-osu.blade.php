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
@if(!Auth::user())
<div class="row">
    <div class="col-md-6">
        You need to be <a href="#" class="js-user-link" title="{{ trans("users.anonymous.login_link") }}">logged in</a> to stuff!
    </div>
</div>
@else
<div class="row" data-user-id="1">
    <div>
        <center>
            <div style="background-image: url('{{ Auth::user()->user_avatar }}');" class="avatar"></div>
        </center>
    </div>
    <div>
        <div>
            <div>Username</div>
            <div>Currently have no supporter tag</div>
            <div>Choose your amount</div>
        </div>
    </div>
    <div>
        <p class="js-price-thing price text-right" data-user-id="1">MONEHS</p>
        <div class="text-right">
            1 month
        </div>
    </div>
    <div>
        <div class="js-slider ui-slider ui-slider-horizontal ui-widget ui-widget-content">
            <div class="ui-slider-handle" data-user-id="1"></div>
        </div>
    </div>
</div>
<div class="row" data-user-id="2">
    <div>
        <center>
            <div style="background-image: url('{{ Auth::user()->user_avatar }}');" class="avatar"></div>
        </center>
    </div>
    <div>
        <div>
            <div>Username</div>
            <div>Currently have no supporter tag</div>
            <div>Choose your amount</div>
        </div>
    </div>
    <div>
        <p class="js-price-thing price text-right" data-user-id="2">MONEHS</p>
        <div class="text-right">
            1 month
        </div>
    </div>
    <div>
        <div class="js-slider ui-slider ui-slider-horizontal ui-widget ui-widget-content">
            <div class="ui-slider-handle" data-user-id="2"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="osu-layout__sub-row" id="add-another-player">
        <div class="big-button">
            <button type="button" class="js-add-player-button btn-osu btn-osu-default">
                {{ trans('add_another_player') }}
            </button>
        </div>
    </div>
</div>
@endif
<script>
  $(function() {
    var RESOLUTION = 8;
    var MIN_VALUE = 4;
    var MAX_VALUE = 52;
    $(".js-slider").slider({
      range: "min",
      value: MIN_VALUE * RESOLUTION,
      min: MIN_VALUE * RESOLUTION,
      max: MAX_VALUE * RESOLUTION,
      slide: function(event, ui) {
        $(".js-price-thing.price").filter(function() {
          return this.dataset.userId == ui.handle.dataset.userId;
        }).text(ui.value);
      }
    });
    $(".js-price-thing.price").text($(".js-slider").slider("value"));
  });
</script>
