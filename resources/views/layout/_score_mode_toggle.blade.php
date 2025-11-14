{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $legacyScoreMode ??= App\Libraries\Search\ScoreSearchParams::showLegacyForUser(Auth::user()) === true;
    $icon = $legacyScoreMode
        ? 'far fa-square'
        : 'fas fa-check-square';
@endphp
<button
    class="{{ $class }}"
    type="button"
    data-url="{{ route('account.options', ['user_profile_customization[legacy_score_only]' => !$legacyScoreMode]) }}"
    data-method="PUT"
    data-remote="1"
    data-reload-on-success="1"
    title="{{ osu_trans("layout.popup_user.links.legacy_score_only_toggle_tooltip") }}"
>
    <span>
        <span class="{{ $icon }}"></span>
        {{ osu_trans("layout.popup_user.links.legacy_score_only_toggle") }}
    </span>
</button>

@if (!$legacyScoreMode)
    <div
        class="js-react u-contents"
        data-class="{{ $class }}"
        data-react="scoring-mode-toggle"
    ></div>
@endif
