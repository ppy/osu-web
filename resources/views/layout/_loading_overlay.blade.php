{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
