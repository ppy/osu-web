{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<span class="{{ class_with_modifiers('flag-country', $modifiers ?? []) }}"
    @if (isset($country_name))
        title="{{$country_name}}"
    @endif
    style="background-image: url('/images/flags/{{$country_code}}.png');"
></span>
