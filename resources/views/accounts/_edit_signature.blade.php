{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{!! Form::open([
    'route' => 'account.update',
    'method' => 'PUT',
    'data-remote' => true,
    'class' => 'account-edit js-account-edit'
]) !!}
    <div class="account-edit__section">
        <h2 class="account-edit__section-title">
            {{ trans('accounts.edit.signature.title') }}
        </h2>
    </div>

    <div class="account-edit__input-groups">
        <div class="account-edit__input-group">

            <div class="account-edit-entry account-edit-entry--wide account-edit-entry--no-label">
                <div class="
                    account-edit-entry__misc-info
                    account-edit-entry__misc-info--signature-preview
                    js-post-preview--preview
                ">
                    {!! bbcode(Auth::user()->user_sig, Auth::user()->user_sig_bbcode_uid) !!}
                </div>
            </div>

            <div class="account-edit-entry account-edit-entry--wide account-edit-entry--no-label">
                <textarea
                    class="account-edit-entry__input js-post-preview--auto js-bbcode-body"
                    name="user[user_sig]"
                    rows=6
                    @if (Auth::user()->isSilenced())
                        disabled
                    @endif
                >{{ bbcode_for_editor(Auth::user()->user_sig, Auth::user()->user_sig_bbcode_uid) }}</textarea>

            </div>

            <div class="account-edit-entry account-edit-entry--wide account-edit-entry--no-label">
                <div class="account-edit-entry__misc-info">
                    @include('forum._post_toolbar', ['disabled' => Auth::user()->isSilenced()])
                </div>
            </div>
        </div>

        <div class="account-edit__input-group">
            <div class="account-edit-entry account-edit-entry--no-label">
                <button
                    class="btn-osu-big btn-osu-big--account-edit"
                    type="submit"
                    data-disable-with="{{ trans('common.buttons.saving') }}"
                    @if (Auth::user()->isSilenced())
                        disabled
                    @endif
                >
                    <div class="btn-osu-big__content">
                        <div class="btn-osu-big__left">
                            {{ trans('accounts.edit.signature.update') }}
                        </div>

                        <div class="btn-osu-big__icon">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                </button>

                @include('accounts._edit_entry_status')
            </div>
        </div>
    </div>
{!! Form::close() !!}
