{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="account-edit" id="totp">
    <div class="account-edit__section">
        <h2 class="account-edit__section-title">
            {{ osu_trans('accounts.user_totp.title') }}
        </h2>
    </div>

    <div class="account-edit__input-groups">
        <div class="account-edit__input-group">
                <div class="account-edit-entry">
                    <div class="account-edit-entry__label account-edit-entry__label--top-pinned">
                        {{ osu_trans('accounts.user_totp.status.label') }}
                    </div>
                    @php
                        $isSet = $user->userTotpKey !== null;
                    @endphp
                    <div class="account-edit-entry__group">
                        <p>
                            {{ osu_trans('accounts.user_totp.status.'.($isSet ? 'set' : 'not_set')) }}
                        </p>
                        @php
                            if ($isSet) {
                                $url = route('user-totp.edit');
                                $text = osu_trans('accounts.user_totp.button.remove');
                                $icon = 'fas fa-trash';
                            } else {
                                $url = route('user-totp.create');
                                $text = osu_trans('accounts.user_totp.button.setup');
                                $icon = 'fas fa-mobile-alt';
                            }
                        @endphp
                        <a class="btn-osu-big" href="{{ $url }}">
                            <span class="btn-osu-big__content">
                                <span class="btn-osu-big__left">
                                    <span class="btn-osu-big__text-top">
                                        {{ $text }}
                                    </span>
                                </span>
                                <span class="btn-osu-big__icon">
                                    <span class="fa-fw {{ $icon }}">
                                    </span>
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
        </div>
    </div>
</div>
