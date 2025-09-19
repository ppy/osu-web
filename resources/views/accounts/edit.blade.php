{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $user = Auth::user();
    $isSilenced = $user->isSilenced();
@endphp

@extends('master', ['titlePrepend' => osu_trans('accounts.edit.title_compact')])

@section('content')
    @if ($isSilenced && !$user->isRestricted())
        @include('objects._notification_banner', [
            'type' => 'alert',
            'title' => osu_trans('users.silenced_banner.title'),
            'message' => osu_trans('users.silenced_banner.message'),
        ])
    @endif

    @include('home._user_header_default', ['themeOverride' => 'settings'])

    <div class="osu-page osu-page--account-edit">
        <div class="account-edit account-edit--first">
            <div class="account-edit__section">
                <h2 class="account-edit__section-title">
                    {{ osu_trans('accounts.edit.profile.title') }}
                </h2>
            </div>

            <div class="account-edit__input-groups">
                <div class="account-edit__input-group">
                    <div class="account-edit-entry account-edit-entry--read-only">
                        <div class="account-edit-entry__label">
                            {{ osu_trans('accounts.edit.username') }}
                        </div>
                        <div class="account-edit-entry__input">
                            {{ $user->username }}
                        </div>

                        <div class="account-edit-entry__button">
                            <a class="btn-osu-big btn-osu-big--account-edit" href="{{route('store.products.show', 'username-change')}}">
                                <div class="btn-osu-big__content">
                                    <div class="btn-osu-big__left">
                                        {{ osu_trans('common.buttons.change') }}
                                    </div>

                                    <div class="btn-osu-big__icon">
                                        <i class="fas fa-pencil-alt"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @include('accounts._edit_country')
                </div>
                <div class="account-edit__input-group">
                    @include('accounts._edit_entry_simple', ['field' => 'user_from'])
                    @include('accounts._edit_entry_simple', ['field' => 'user_interests'])
                    @include('accounts._edit_entry_simple', ['field' => 'user_occ'])
                </div>
                <div class="account-edit__input-group">
                    @include('accounts._edit_entry_simple', ['field' => 'user_twitter'])
                    @include('accounts._edit_entry_simple', ['field' => 'user_discord'])
                    @include('accounts._edit_entry_simple', ['field' => 'user_website'])
                </div>
            </div>
        </div>

        <div class="account-edit" id="avatar">
            <div class="account-edit__section">
                <h2 class="account-edit__section-title">
                    {{ osu_trans('accounts.edit.avatar.title') }}
                </h2>
            </div>

            <div class="account-edit__input-groups">
                <div class="account-edit__input-group">
                    <div class="account-edit-entry account-edit-entry--block js-account-edit-avatar">
                        <div class="account-edit-entry__avatar">
                            <div class="avatar avatar--full-rounded js-current-user-avatar"></div>

                            <div class="account-edit-entry__drop-overlay">
                                <span>
                                {{ osu_trans('common.dropzone.target') }}
                                </span>
                            </div>

                            <div class="account-edit-entry__overlay-spinner">
                                {!! spinner() !!}
                            </div>
                        </div>

                        <p>
                            <label
                                class="btn-osu-big btn-osu-big--account-edit"
                                @if ($isSilenced)
                                    disabled
                                @endif
                            >
                                <span class="btn-osu-big__content">
                                    <span class="btn-osu-big__left">
                                        {{ osu_trans('common.buttons.upload_image') }}
                                    </span>

                                    <span class="btn-osu-big__icon">
                                        <i class="far fa-arrow-alt-circle-up"></i>
                                    </span>
                                </span>

                                <input
                                    class="js-account-edit-avatar__button fileupload"
                                    type="file"
                                    name="avatar_file"
                                    data-url="{{ route('account.avatar') }}"
                                    @if ($isSilenced)
                                        disabled
                                    @endif
                                >
                            </label>
                        </p>

                        <p>
                            <button
                                class="btn-osu-big btn-osu-big--account-edit js-account-edit-avatar--reset"
                                type="button"
                                data-url="{{ route('account.avatar') }}"
                                data-method="POST"
                                data-remote
                                data-confirm="{{ osu_trans('common.confirmation') }}"
                                @if ($isSilenced)
                                    disabled
                                @endif
                            >
                                <span class="btn-osu-big__content">
                                    <span class="btn-osu-big__left">
                                        {{ osu_trans('accounts.edit.avatar.reset') }}
                                    </span>

                                    <span class="btn-osu-big__icon">
                                        <i class="fas fa-times"></i>
                                    </span>
                                </span>
                            </button>
                        </p>

                        <div class="account-edit-entry__rules">
                            {!! osu_trans('accounts.edit.avatar.rules', [
                                'link' => link_to(
                                    wiki_url('Rules/Visual_content_considerations'),
                                    osu_trans('accounts.edit.avatar.rules_link')
                                )
                            ]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('accounts._edit_signature')

        @include('accounts._edit_playstyles')

        @include('accounts._edit_privacy')

        @include('accounts._edit_notifications')

        @include('accounts._edit_options')

        @include('accounts._edit_password')

        @include('accounts._edit_email')

        @include('accounts._edit_user_totp')

        @include('accounts._edit_sessions')

        @include('accounts._edit_oauth')

        @if (\App\Models\GithubUser::canAuthenticate())
            @include('accounts._edit_github_user')
        @endif

        @include('accounts._edit_legacy_api')
    </div>
@endsection

@section("script")
  <script id="json-authorized-clients" type="application/json">
    {!! json_encode($authorizedClients) !!}
  </script>

  <script id="json-own-clients" type="application/json">
    {!! json_encode($ownClients) !!}
  </script>

  @include('layout._react_js', ['src' => 'js/account-edit.js'])
@endsection
