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

<div class='address'>
    <div>{{ $data->first_name }} {{ $data->last_name }}</div>
    <div>{{ $data->street }}</div>
    <div>{{ implode(', ', array_filter([$data->city, $data->state, $data->zip])) }}</div>
    <div>{{ $data->countryName() }}</div>
    <div>{{ $data->phone }}</div>
</div>
