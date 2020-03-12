{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
