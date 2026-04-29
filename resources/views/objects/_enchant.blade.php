{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if ($GLOBALS['cfg']['services']['enchant']['id'] !== null)
    <script class="enchant-help-center" type="application/json" data-enchant-messenger-id="{{ $GLOBALS['cfg']['services']['enchant']['id'] }}"></script>
@endif
