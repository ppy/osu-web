{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    if (is_string($country)) {
        $country = ['acronym' => $country];
    }
@endphp
<span class="{{ class_with_modifiers('flag-country', $modifiers ?? []) }}"
    @if (isset($country['name']))
        title="{{ $country['name'] }}"
    @endif
    style="background-image: url('{{ flag_url($country['acronym']) }}');"
></span>
