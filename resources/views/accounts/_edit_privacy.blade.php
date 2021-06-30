{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="account-edit">
    <div class="account-edit__section">
        <h2 class="account-edit__section-title">
            {{ osu_trans('accounts.privacy.title') }}
        </h2>
    </div>

    <div class="account-edit__input-groups">
        <div class="account-edit__input-group">
            <div
                class="account-edit-entry account-edit-entry--no-label js-account-edit"
                data-account-edit-auto-submit="1"
                data-url="{{ route('account.options') }}"
            >
                <label class="account-edit-entry__checkbox">
                    @include('objects._switch', [
                        'additionalClass' => 'js-account-edit__input',
                        'checked' => auth()->user()->pm_friends_only,
                        'name' => 'user[pm_friends_only]',
                    ])

                    <span class="account-edit-entry__checkbox-label">
                        {{ osu_trans('accounts.privacy.friends_only') }}
                    </span>

                    <div class="account-edit-entry__checkbox-status">
                        @include('accounts._edit_entry_status')
                    </div>
                </label>
            </div>

            <div
                class="account-edit-entry account-edit-entry--no-label js-account-edit"
                data-account-edit-auto-submit="1"
                data-url="{{ route('account.options') }}"
            >
                <label class="account-edit-entry__checkbox">
                    @include('objects._switch', [
                        'additionalClass' => 'js-account-edit__input',
                        'checked' => auth()->user()->hide_presence,
                        'name' => 'user[hide_presence]',
                    ])

                    <span class="account-edit-entry__checkbox-label">
                        {{ osu_trans('accounts.privacy.hide_online') }}
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
                        {{ osu_trans('users.blocks.blocked_count', ['count' => count($blocks)]) }}
                    </div>
                    <div class="block-list">
                        <a class='block-list__toggle js-account-edit-blocklist' href='#'>{{osu_trans('common.buttons.show')}}</a>
                        <div class="block-list__content hidden">
                            @foreach ($blocks as $block)
                                <div class="block-list-item">
                                    <a class="block-list-item__link" href='{{route('users.show', $block->user_id)}}'>{{ $block->username }}</a>
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
