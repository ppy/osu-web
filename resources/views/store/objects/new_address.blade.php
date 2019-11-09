{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{!! Form::open(['action' => 'StoreController@postNewAddress', "data-remote" => true]) !!}
<div class="{{{ count($addresses) ? "initially-hidden" : "" }}}" id="new-address-form">
    <div class="grid grid--gutters">
        <div class="grid-cell grid-cell--fill">
            <h3>Adding new shipping address</h3>
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
    <button type="submit" class="btn-osu btn-osu-default {{{ count($addresses) ? "initially-hidden" : "" }}}">Add address</button>
    @if(count($addresses))
    <a href="#" class="btn-osu btn-osu-default">Add new shipping address</a>
    @endif
</div>
{!! Form::close() !!}
