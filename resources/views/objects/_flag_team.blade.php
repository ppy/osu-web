{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<span
    class="flag-team"
    title="{{ $team->name }}"
    {!! background_image($team->logo()->url(), false) !!}
></span>
