{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="js-react--user-card"
     data-modifiers="{{ json_encode($_modifiers ?? [])}}"
     data-user="{{ json_encode(json_item($user, 'UserCompact', ['cover', 'country'])) }}">
</div>
