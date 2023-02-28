{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="account-edit">
    <div class="account-edit__section">
        <h2 class="account-edit__section-title">
            {{ osu_trans('accounts.oauth.title') }}
        </h2>
    </div>

    <div class="account-edit__input-groups">
        <div class="account-edit__input-group">
            <div class="account-edit-entry">
                <div class="account-edit-entry__label account-edit-entry__label--top-pinned">{{ osu_trans('accounts.oauth.authorized_clients') }}</div>
                <div class="account-edit__input-groups">
                    <div class="js-react--authorized-clients"></div>
                </div>
            </div>
        </div>

        <div class="account-edit__input-group">
            <div class="account-edit-entry">
                <div class="account-edit-entry__label account-edit-entry__label--top-pinned">{{ osu_trans('accounts.oauth.own_clients') }}</div>
                <div class="account-edit__input-groups">
                    <div class="js-react--own-clients"></div>
                </div>
            </div>
        </div>
    </div>
</div>
