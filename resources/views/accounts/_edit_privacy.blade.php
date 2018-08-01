{{--
    Copyright 2015-2017 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
<div class="account-edit">
    <div class="account-edit__section">
        <h2 class="account-edit__section-title">
            {{ trans('accounts.privacy.title') }}
        </h2>
    </div>

    <div class="account-edit__input-groups">
        <div class="account-edit__input-group">
            <div class="account-edit-entry account-edit-entry--no-label js-account-edit" data-account-edit-auto-submit="1" data-skip-ajax-error-popup="1">
                <label class="account-edit-entry__checkbox">
                    <div class="osu-checkbox">
                        <input
                            name="user[pm_friends_only]"
                            class="osu-checkbox__input js-account-edit__input"
                            type="checkbox"
                            @if (Auth::user()->pm_friends_only)
                                checked
                            @endif
                        >
                        <span class="osu-checkbox__box"></span>
                        <span class="osu-checkbox__tick">
                            <i class="fas fa-check"></i>
                        </span>
                    </div>

                    <span class="account-edit-entry__checkbox-label">
                        {{ trans('accounts.privacy.friends_only') }}
                    </span>

                    <div class="account-edit-entry__checkbox-status">
                        @include('accounts._edit_entry_status')
                    </div>
                </label>
            </div>

            <div class="account-edit-entry account-edit-entry--no-label js-account-edit" data-account-edit-auto-submit="1" data-skip-ajax-error-popup="1">
                <label class="account-edit-entry__checkbox">
                    <div class="osu-checkbox">
                        <input
                            name="user[hide_presence]"
                            class="osu-checkbox__input js-account-edit__input"
                            type="checkbox"
                            @if (Auth::user()->hide_presence)
                                checked
                            @endif
                        >
                        <span class="osu-checkbox__box"></span>
                        <span class="osu-checkbox__tick">
                            <i class="fas fa-check"></i>
                        </span>
                    </div>

                    <span class="account-edit-entry__checkbox-label">
                        {{ trans('accounts.privacy.hide_online') }}
                    </span>

                    <div class="account-edit-entry__checkbox-status">
                        @include('accounts._edit_entry_status')
                    </div>
                </label>
            </div>
        </div>
        @if (count($blocks) > 0)
            <div class="account-edit__input-group">
                <div class="account-edit-entry">
                    <div class="account-edit-entry__label account-edit-entry__label--top-pinned js-account-edit-blocklist-count">
                        {{ trans('users.blocks.blocked_count', ['count' => count($blocks)]) }}
                    </div>
                    <div class="user-list">
                        <a class='user-list__toggle js-account-edit-blocklist' href='#'>{{trans('common.buttons.show')}}</a>
                        <div class="user-list__content hidden">
                            @foreach ($blocks as $block)
                                <div class="user-list-item">
                                    <a class="user-list-item__link" href='{{route('users.show', $block->user_id)}}'>{{ $block->username }}</a>
                                    <div class="js-react--blockButton" data-target="{{$block->user_id}}"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
