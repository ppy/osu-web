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
<div class="loading-overlay js-loading-overlay">
    <div class="loading-overlay__container">
        @foreach (range(1, 4) as $n)
            <div class="loading-overlay__follow-point
                    loading-overlay__follow-point--{{ $n }}">
                ›
            </div>

            @foreach (['approach', 'hit'] as $type)
                <div class="loading-overlay__circle
                        loading-overlay__circle--{{ $n }}
                        loading-overlay__circle--{{ $type }}"
                ></div>
            @endforeach
        @endforeach
    </div>
</div>
