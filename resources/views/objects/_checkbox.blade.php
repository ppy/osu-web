{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
<div class="osu-checkbox">
    @if (!isset($value))
        <input type="hidden" name="{{ $name }}" value="0">
    @endif
    <input
        type="checkbox"
        class="osu-checkbox__input" name="{{ $name }}"
        value="{{ isset($value) ? $value : '1' }}"
        @if ($checked ?? false)
            checked
        @endif
    >
    <span class="osu-checkbox__box"></span>
    <span class="osu-checkbox__tick">
        <i class="fas fa-check"></i>
    </span>
</div>
