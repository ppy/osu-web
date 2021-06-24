{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', ['titlePrepend' => trans('accounts.edit.title_compact')])

@section('content')
    @if (Auth::user()->isSilenced() && !Auth::user()->isRestricted())
        @include('objects._notification_banner', [
            'type' => 'alert',
            'title' => trans('users.silenced_banner.title'),
            'message' => trans('users.silenced_banner.message'),
        ])
    @endif

    @include('home._user_header_default', ['themeOverride' => 'settings'])

    <div class="osu-page u-has-anchor">
        <div class="account-edit account-edit--first">
            <div class="account-edit__section">
                <h2 class="account-edit__section-title">
                    {{ trans('accounts.edit.profile.title') }}
                </h2>
            </div>

            <div class="account-edit__input-groups">
                <div class="account-edit__input-group">
                    <div class="account-edit-entry account-edit-entry--read-only">
                        <div class="account-edit-entry__label">
                            {{ trans('accounts.edit.username') }}
                        </div>
                        <div class="account-edit-entry__input">
                            {{ Auth::user()->username }}
                        </div>

                        <div class="account-edit-entry__button">
                            <a class="btn-osu-big btn-osu-big--account-edit" href="{{route('store.products.show', 'username-change')}}">
                                <div class="btn-osu-big__content">
                                    <div class="btn-osu-big__left">
                                        {{ trans('common.buttons.change') }}
                                    </div>

                                    <div class="btn-osu-big__icon">
                                        <i class="fas fa-pencil-alt"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
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
    </div>

    <div class="osu-page u-has-anchor">
        <div id="avatar" class="fragment-target">{{-- anchor won't offset properly if included in the flex container below --}}</div>
        <div class="account-edit">
            <div class="account-edit__section">
                <h2 class="account-edit__section-title">
                    {{ trans('accounts.edit.avatar.title') }}
                </h2>
            </div>

            <div class="account-edit__input-groups">
                <div class="account-edit__input-group">
                    <div class="account-edit-entry account-edit-entry--avatar js-account-edit-avatar">
                        <div class="account-edit-entry__avatar">
                            <div class="avatar avatar--full-rounded js-current-user-avatar"></div>

                            <div class="account-edit-entry__drop-overlay">
                                <span>
                                {{ trans('common.dropzone.target') }}
                                </span>
                            </div>

                            <div class="account-edit-entry__overlay-spinner">
                                @include('objects._spinner')
                            </div>
                        </div>

                        <label
                            class="btn-osu-big btn-osu-big--account-edit"
                            @if (Auth::user()->isSilenced())
                                disabled
                            @endif
                        >
                            <div class="btn-osu-big__content">
                                <div class="btn-osu-big__left">
                                    {{ trans('common.buttons.upload_image') }}
                                </div>

                                <div class="btn-osu-big__icon">
                                    <i class="far fa-arrow-alt-circle-up"></i>
                                </div>
                            </div>

                            <input
                                class="js-account-edit-avatar__button fileupload"
                                type="file"
                                name="avatar_file"
                                data-url="{{ route('account.avatar') }}"
                                @if (Auth::user()->isSilenced())
                                    disabled
                                @endif
                            >
                        </label>

                        <div class="account-edit-entry__rules">
                            {!! trans('accounts.edit.avatar.rules', [
                                'link' => link_to(
                                    wiki_url('Rules'),
                                    trans('accounts.edit.avatar.rules_link')
                                )
                            ]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="osu-page u-has-anchor">
        @include('accounts._edit_signature')
    </div>

    <div class="osu-page u-has-anchor">
        @include('accounts._edit_playstyles')
    </div>

    <div class="osu-page u-has-anchor">
        @include('accounts._edit_privacy')
    </div>

    <div class="osu-page u-has-anchor">
        <div id="notifications" class="fragment-target"></div>
        @include('accounts._edit_notifications')
    </div>

    <div class="osu-page u-has-anchor">
        @include('accounts._edit_options')
    </div>

    <div class="osu-page u-has-anchor">
        @include('accounts._edit_password')
    </div>

    <div class="osu-page u-has-anchor">
        @include('accounts._edit_email')
    </div>

    <div class="osu-page u-has-anchor">
        @include('accounts._edit_sessions')
    </div>

    <div class="osu-page u-has-anchor">
        <div id="oauth" class="fragment-target"></div>
        @include('accounts._edit_oauth')
    </div>
@endsection

@section("script")
  <script id="json-authorized-clients" type="application/json">
    {!! json_encode($authorizedClients) !!}
  </script>

  <script id="json-own-clients" type="application/json">
    {!! json_encode($ownClients) !!}
  </script>

  @include('layout._react_js', ['src' => 'js/react/account-edit.js'])
@endsection
