{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<ul class="game-mode">
    @foreach (App\Models\Beatmap::MODES as $tab => $_int)
        <li>
            <a
                class="{{ class_with_modifiers('game-mode-link', ['active' => $mode === $tab ]) }}"
                href="{{ $rankingUrl($type, $tab) }}"
            >
                <span
                    class="fal fa-extra-mode-{{ $tab }}"
                    title="{{ osu_trans("beatmaps.mode.{$tab}") }}"
                ></span>
            </a>
        </li>
    @endforeach
</ul>
