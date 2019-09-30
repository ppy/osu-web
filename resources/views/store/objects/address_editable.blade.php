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
<div class="{{{ $grid ?? 'grid-cell' }}}" id="address-{{ $data->address_id }}">
    <div>
        {!! Form::open(['route' => ['admin.store.addresses.update', $data->address_id], 'class' => 'editable-content-form', 'method' => 'put', 'data-remote' => true]) !!}
            <div class="first_name">
                <span class="content-editable-submit" contenteditable="true" data-name="address[first_name]">{{{$data->first_name}}}</span> <span class="content-editable-submit" contenteditable="true" data-name="address[last_name]">{{{$data->last_name}}}</span></div>
            <div class="street">
                <span class="content-editable-submit" contenteditable="true" data-name="address[street]">{{{$data->street}}}</span></div>
            <div class="city">
                <span class="content-editable-submit" contenteditable="true" data-name="address[city]">{{{$data->city}}}</span>,
                <span class="content-editable-submit" contenteditable="true" data-name="address[state]">{{{$data->state}}}</span>,
                <span class="content-editable-submit" contenteditable="true" data-name="address[zip]">{{{$data->zip}}}</span>
            </div>
            <div class="country">{{{ $data->countryName()}}}</div>
            <div class="phone">
                <span class="content-editable-submit" contenteditable="true" data-name="address[phone]">{{{$data->phone}}}</span>
            </div>
        {!! Form::close() !!}
    </div>
</div>
