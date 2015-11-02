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
<div class="{{{ $grid or 'col-md-6' }}}" id="address-{{ $data->address_id }}">
    <div class="{{{ isset($selected) ? ($selected ? "shadow-selected" : "shadow-hover") : "" }}} address">
        @if((isset($modifiable) && $modifiable))
        {!! Form::open(['action' => 'StoreController@postUpdateAddress', "data-remote" => true]) !!}
        @endif

            <div>{{{$data->first_name}}} {{{$data->last_name}}}</div>
            <div class="street">{{{$data->street}}}</div>
            <div class="city">{{{$data->city}}}, {{{$data->state}}}, {{{$data->zip}}}</div>
            <div class="country">{{{$data->countryName()}}}</div>
            <div class="phone">{{{$data->phone}}}</div>

        @if((isset($modifiable) && $modifiable))
            {!! Form::hidden('id', $data->address_id) !!}

            <button type="submit" class="address-delete-button" name="action" value="remove"><i class="fa fa-trash-o"></i></button>
            <button type="submit" class="address-select-button" name="action" value="use"><i class="fa fa-check"></i> Use</button>
        @endif

        @if((isset($modifiable) && $modifiable))
        {!! Form::close() !!}
        @endif
    </div>
</div>
