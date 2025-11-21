{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="account-edit" id="github">
    <div class="account-edit__section">
        <h2 class="account-edit__section-title">
            {{ osu_trans('accounts.github_user.title') }}
        </h2>
    </div>

    <div class="account-edit__input-groups">
        <div
            class="account-edit__input-group js-react"
            data-react="github-user"
            data-user="{{ json_encode($githubUser) }}"
        ></div>
    </div>
</div>
