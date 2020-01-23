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
    $modifiable = $modifiable ?? false;
    $isCard = isset($selected);

    if ($isCard) {
        $modifiers[] = 'card';

        if ($selected) {
            $modifiers[] = 'card-active';
        } else {
            $modifiers[] = 'card-hover';
            $withButtons = true;
        }
    }

    $mainClasses = class_with_modifiers('address', $modifiers ?? []);
    $withButtons = $withButtons ?? false;

    if ($withButtons) {
        $mainClasses .= ' clickable-row';
    }
@endphp
{!! Form::open([
    'action' => 'StoreController@postUpdateAddress',
    'class' => $mainClasses,
    'data-remote' => true,
    'id' => "address-{$data->address_id}",
]) !!}
    <div>{{ $data->first_name }} {{ $data->last_name }}</div>
    <div>{{ $data->street }}</div>
    <div>{{ $data->city }}, {{ $data->state }}, {{ $data->zip }}</div>
    <div>{{ $data->countryName() }}</div>
    <div>{{ $data->phone }}</div>

    @if ($withButtons)
        {!! Form::hidden('id', $data->address_id) !!}

        <button type="submit" class="address__button-delete" name="action" value="remove">
            <i class="fas fa-trash"></i>
        </button>

        <button type="submit" class="clickable-row-link address__button-select" name="action" value="use">
            <i class="fas fa-check"></i> Use
        </button>
    @endif
{!! Form::close() !!}
