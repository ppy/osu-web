{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="account-edit">
    <div class="account-edit__section">
        <h2 class="account-edit__section-title">
            {{ osu_trans('accounts.github_user.title') }}
        </h2>
    </div>

    <div class="account-edit__input-groups">
        <div class="account-edit__input-group">
            <div class="account-edit-entry">
                <div class="account-edit-entry__label">
                    {{ osu_trans('accounts.github_user.account')}}
                </div>
                <div class="account-edit__input-groups">
                    <div
                        class="js-react--github-user"
                        data-user="{{ json_encode($githubUser) }}"
                    ></div>
                </div>
            </div>
        </div>
    </div>
</div>
