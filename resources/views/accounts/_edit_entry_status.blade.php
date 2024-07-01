{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="{{ class_with_modifiers('account-edit-status', $modifiers ?? []) }}">
    <div class="account-edit-status__content account-edit-status__content--saving">
        {!! spinner() !!}
    </div>

    <div class="account-edit-status__content account-edit-status__content--saved">
        {{ osu_trans('common.saved') }}
    </div>
</div>
