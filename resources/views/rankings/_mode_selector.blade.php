{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<div class="game-mode">
    <ul class="game-mode__items">
        @foreach (App\Models\Beatmap::MODES as $tab => $_int)
            <li class="game-mode__item">
                <a
                    class="
                        game-mode-link
                        {{$mode === $tab ? ' game-mode-link--active' : ''}}
                    "
                    href="{{ $route($tab, $type) }}"
                >
                    {{ osu_trans("beatmaps.mode.{$tab}") }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
