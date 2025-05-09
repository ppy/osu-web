{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<ul class="game-mode">
    @foreach (App\Models\Beatmap::MODES as $ruleset => $_rulesetId)
        <li>
            <a
                class="{{ class_with_modifiers('game-mode-link', ['active' => $ruleset === $currentRuleset]) }}"
                href="{{ $urlFn($ruleset) }}"
            >
                <span
                    class="fal fa-extra-mode-{{ $ruleset }}"
                    title="{{ osu_trans("beatmaps.mode.{$ruleset}") }}"
                ></span>
                @if (isset($defaultRuleset) && $ruleset === $defaultRuleset)
                    <span
                      class="game-mode-link__icon"
                      title="{{ osu_trans('users.show.edit.default_playmode.is_default_tooltip') }}"
                    >
                      <span class="fas fa-star"></span>
                    </span>
                @endif
            </a>
        </li>
    @endforeach
</ul>
