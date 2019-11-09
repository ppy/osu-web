{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<?php
    $mainClasses = 'address';

    if (isset($selected)) {
        if ($selected) {
            $mainClasses .= ' shadow-selected';
        } else {
            $mainClasses .= ' shadow-hover';

            if (isset($modifiable) && $modifiable) {
                $mainClasses .= ' clickable-row';
            }
        }
    }
?>
<div class="{{{ $grid ?? 'grid-cell grid-cell--1of2' }}}" id="address-{{ $data->address_id }}">
    <div class="{{ $mainClasses }}">
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

            <button type="submit" class="address-delete-button" name="action" value="remove"><i class="fas fa-trash"></i></button>
            <button type="submit" class="clickable-row-link address-select-button" name="action" value="use"><i class="fas fa-check"></i> Use</button>
        @endif

        @if((isset($modifiable) && $modifiable))
        {!! Form::close() !!}
        @endif
    </div>
</div>
