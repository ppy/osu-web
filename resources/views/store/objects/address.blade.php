{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
