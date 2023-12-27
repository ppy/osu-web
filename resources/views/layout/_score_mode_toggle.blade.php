{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $legacyScoreOnlyValue = (int) App\Libraries\Search\ScoreSearchParams::showLegacyForUser(Auth::user());
@endphp
<button
    class="{{ $class }}"
    type="button"
    data-url="{{ route('account.options', ['user_profile_customization[legacy_score_only]' => !$legacyScoreOnlyValue]) }}"
    data-method="PUT"
    data-remote="1"
    data-reload-on-success="1"
    title="{{ osu_trans("layout.popup_user.links.legacy_score_only_toggle_tooltip.{$legacyScoreOnlyValue}") }}"
>
    {{ osu_trans("layout.popup_user.links.legacy_score_only_toggle.{$legacyScoreOnlyValue}") }}
</button>

