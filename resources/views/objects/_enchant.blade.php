{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if (config('services.enchant.id') !== null)
    <div class="enchant-help-center" data-id="{{ config('services.enchant.id') }}"></div>
@endif
