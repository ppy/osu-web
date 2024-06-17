{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if ($GLOBALS['cfg']['services']['enchant']['id'] !== null)
    <div class="enchant-help-center" data-id="{{ $GLOBALS['cfg']['services']['enchant']['id'] }}"></div>
@endif
