{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="account-edit">
    <div class="account-edit__section">
        <h2 class="account-edit__section-title">
            {{ osu_trans('accounts.edit.legacy_api.title') }}
        </h2>
    </div>

    <div class="account-edit__input-groups">
        <div class="account-edit__input-group">
            <div class="account-edit-entry">
                <div class="account-edit-entry__label account-edit-entry__label--top-pinned">{{ osu_trans('accounts.edit.legacy_api.api') }}</div>
                <div class="account-edit__input-groups">
                    <div
                        class="js-react--legacy-api-key"
                        data-state="{{ json_encode(['legacy_api_key' => $legacyApiKeyJson]) }}"
                    ></div>
                </div>
            </div>
        </div>

        <div class="account-edit__input-group">
            <div class="account-edit-entry">
                <div class="account-edit-entry__label account-edit-entry__label--top-pinned">{{ osu_trans('accounts.edit.legacy_api.irc') }}</div>
                <div class="account-edit__input-groups">
                    <div
                        class="js-react--legacy-irc-key"
                        data-state="{{ json_encode(['legacy_irc_key' => $legacyIrcKeyJson]) }}"
                    ></div>
                </div>
            </div>
        </div>
    </div>
</div>
