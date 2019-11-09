{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="account-edit">
    <div class="account-edit__section">
        <h2 class="account-edit__section-title">
            {{ trans('accounts.playstyles.title') }}
        </h2>
    </div>

    <div class="account-edit__input-groups">
        <div class="account-edit__input-group">
            <div class="account-edit-entry account-edit-entry--no-label">
                <form
                    class="account-edit-entry__checkboxes js-account-edit"
                    data-account-edit-auto-submit="1"
                    data-account-edit-type="array"
                    data-url="{{ route('account.update') }}"
                    data-field="user[osu_playstyle]"
                >
                    @foreach (App\Models\User::PLAYSTYLES as $key => $_value)
                        <label class="account-edit-entry__checkbox account-edit-entry__checkbox--inline">
                            @include('objects._switch', [
                                'checked' => in_array($key, auth()->user()->osu_playstyle ?? [], true),
                                'value' => $key,
                            ])

                            <span class="account-edit-entry__checkbox-label">
                                {{ trans("accounts.playstyles.{$key}") }}
                            </span>
                        </label>
                    @endforeach

                    <div class="account-edit-entry__checkboxes-status">
                        @include('accounts._edit_entry_status')
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
