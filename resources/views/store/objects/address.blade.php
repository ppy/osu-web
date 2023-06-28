{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<div class='address'>
    <div>{{ $data->first_name }} {{ $data->last_name }}</div>
    <div>{{ $data->street }}</div>
    <div>{{ implode(', ', array_filter([$data->city, $data->state, $data->zip])) }}</div>
    <div>{{ $data->countryName() }}</div>
    <div>{{ $data->phone }}</div>
</div>
