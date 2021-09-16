{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="{{ class_with_modifiers('flag-country', $modifiers ?? []) }}"
    @if (isset($countryName))
        title="{{ $countryName }}"
    @endif
    style="background-image: url('{{ flag_url($countryCode) }}');"
></div>
