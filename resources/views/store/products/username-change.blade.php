{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@if(!Auth::user())
<div class="row">
	<div class="col-md-6">
		You need to be <a href="#" title="{{ trans("users.anonymous.login") }}" data-toggle="modal" data-target="#login-modal">logged in</a> to change your name!
	</div>
</div>
@else
<div class="row">
	<div class="col-sm-2">
		<center>
			<div style="background-image: url('{{ Auth::user()->user_avatar }}');" class="avatar"></div>
		</center>
	</div>
	<div class="col-sm-5">
		<div>
			<input type="hidden" name="item[product_id]" value="{{ $product->product_id }}" />
			<input type="hidden" name="item[quantity]" value="1" />
			<input type="hidden" id="username-form-price" name="item[cost]" value="0" />
			{!! Form::label('username', 'New Username') !!}
			{!! Form::text('item[extra_info]', '', ['id' => 'username', 'class' => 'form-control', 'placeholder' => 'Requested Username', 'autocomplete' => 'off']) !!}
		</div>
		<strong>
			<div id="username-check-status">Enter a username to check availability!</div>
		</strong>
		<div>Your current username is "<i>{{ Auth::user()->username }}</i>".</div>
	</div>
	<div class="col-sm-3 col-sm-offset-2 price-box">
		<p class="price" id="username-check-price"></p>
	</div>
</div>
@endif
