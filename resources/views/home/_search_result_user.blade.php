{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="js-react--user-cards"
     data-modifiers="{{ json_encode(['search']) }}"
     data-users="{{ json_encode(json_collection($search->data(), 'UserCompact', ['cover', 'country', 'groups'])) }}">
</div>
