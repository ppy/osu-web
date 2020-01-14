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
@php
    $showForm = count($addresses) === 0;
@endphp
{!! Form::open(['action' => 'StoreController@postNewAddress', "data-remote" => true]) !!}
<div id="new-address-form" {!! $showForm ? '' : 'style="display: none;"' !!}>
    <div class="grid grid--gutters">
        <div class="grid-cell grid-cell--fill">
            <h3 class="store-text store-text--title store-text--title-small">Adding new shipping address</h3>
        </div>

        <div class='form-group grid-cell grid-cell--1of2'>
            {!! Form::label('address[first_name]', 'First Name', ["class" => "sr-only"]) !!}
            {!! Form::text("address[first_name]", null, ['class' => 'form-control', "placeholder" => "First Name"]) !!}
        </div>
        <div class='form-group grid-cell grid-cell--1of2'>
            {!! Form::label('address[last_name]', 'Last Name', ["class" => "sr-only"]) !!}
            {!! Form::text("address[last_name]", null, ['class' => 'form-control', "placeholder" => "Last Name"]) !!}
        </div>
        <div class='form-group grid-cell grid-cell--1of2'>
            {!! Form::label('address[street]', 'Street Number, Name, Building, etc', ["class" => "sr-only"]) !!}
            {!! Form::text("address[street]", null, ['class' => 'form-control', "placeholder" => "Street Number, Name, Building, etc"]) !!}
        </div>
        <div class='form-group grid-cell grid-cell--1of2'>
            {!! Form::label('address[city]', 'City', ["class" => "sr-only"]) !!}
            {!! Form::text("address[city]", null, ['class' => 'form-control', "placeholder" => "City"]) !!}
        </div>
        <div class='form-group grid-cell grid-cell--1of2'>
            {!! Form::label('address[state]', 'State', ["class" => "sr-only"]) !!}
            {!! Form::text("address[state]", null, ['class' => 'form-control', "placeholder" => "State"]) !!}
        </div>
        <div class='form-group grid-cell grid-cell--1of2'>
            {!! Form::label('address[zip]', 'Post Code', ["class" => "sr-only"]) !!}
            {!! Form::text("address[zip]", null, ['class' => 'form-control', "placeholder" => "Post Code"]) !!}
        </div>
        <div class='form-group grid-cell grid-cell--1of2'>
            {!! Form::label('address[country_code]', 'Country', ["class" => "sr-only"]) !!}
            {!!Form::select('address[country_code]', countries_array_for_select(), request_country(), ['class' => 'form-control']) !!}
        </div>
        <div class='form-group grid-cell grid-cell--1of2'>
            {!! Form::label('address[phone]', 'Phone Number', ["class" => "sr-only"]) !!}
            {!! Form::text("address[phone]", null, ['class' => 'form-control', "placeholder" => "Phone Number"]) !!}
        </div>
    </div>
</div>

<div class='form-group big-button' id="new-address-switch">
    <button
        type="submit"
        class="btn-osu-big btn-osu-big--store-action"
        {!! $showForm ? '' : 'style="display: none;"' !!}
    >
        Add address
    </button>
    @if (!$showForm)
        <a href="#" class="btn-osu-big btn-osu-big--store-action">Add new shipping address</a>
    @endif
</div>
{!! Form::close() !!}
