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
<label class="osu-switch-v2">
    @if (isset($defaultValue))
        <input
            type="hidden"
            @if (isset($name))
                name="{{ $name }}"
            @endif
            value="{{ $defaultValue }}"
        />
    @endif
    <input
        class="osu-switch-v2__input {{ $additionalClass ?? '' }}"
        type="{{ $type ?? 'checkbox' }}"
        @if (isset($name))
            name="{{ $name }}"
        @endif
        @if (isset($value))
            value="{{ $value }}"
        @endif
        @if ($checked ?? false)
            checked
        @endif
        @foreach ($attributes ?? [] as $k => $v)
            {!! $k !!}="{{ $v }}"
        @endforeach
    />
    <span class="osu-switch-v2__content"></span>
</label>
