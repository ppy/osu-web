{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $errors = $team->validationErrors()->all();

    $autofocus = count($errors) === 0
        ? 'name'
        : (isset($errors['name'])
            ? 'name'
            : 'short_name'
        );
@endphp
@extends('master')

@section('content')
    @include('layout._page_header_v4')

    <form method="POST" action="{{ route('teams.store') }}" class="osu-page osu-page--generic-compact">
        <div class="user-profile-pages user-profile-pages--no-tabs">
            <div class="page-extra">
                <h2 class="title title--page-extra-small">
                    {{ osu_trans('teams.create.intro.title') }}
                </h2>
                <div>
                    {{ osu_trans('teams.create.intro.description') }}
                </div>
            </div>

            <div class="page-extra">
                <h2 class="title title--page-extra-small">
                    {{ osu_trans('teams.create.form.title') }}
                </h2>

                <div class="team-settings">
                    <div class="team-settings__item">
                        <label class="{{ class_with_modifiers(
                            'input-container',
                            ['error' => isset($errors['name'])],
                        ) }}">
                            <span class="input-container__label">
                                {{ osu_trans('teams.create.form.name') }}
                            </span>
                            <input
                                {{ $autofocus === 'name' ? 'autofocus' : '' }}
                                class="input-text"
                                name="team[name]"
                                required
                                value="{{ $team->name }}"
                            />
                        </label>
                        <div class="team-settings__help">
                            {{ osu_trans('teams.create.form.name_help') }}

                            @if (isset($errors['name']))
                                <ul class="team-settings__errors">
                                    @foreach ($errors['name'] as $error)
                                        <li>{{ $error }}
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>

                    <div class="team-settings__item">
                        <label class="{{ class_with_modifiers(
                            'input-container',
                            ['error' => isset($errors['short_name'])],
                        ) }}">
                            <span class="input-container__label">
                                {{ osu_trans('teams.create.form.short_name') }}
                            </span>
                            <input
                                {{ $autofocus === 'short_name' ? 'autofocus' : '' }}
                                class="input-text"
                                name="team[short_name]"
                                required
                                value="{{ $team->short_name }}"
                            />
                        </label>
                        <div class="team-settings__help">
                            {{ osu_trans('teams.create.form.short_name_help') }}

                            @if (isset($errors['short_name']))
                                <ul class="team-settings__errors">
                                    @foreach ($errors['short_name'] as $error)
                                        <li>{{ $error }}
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-extra">
                <div class="team-settings">
                    <div class="team-settings__item team-settings__item--buttons">
                        <div></div>
                        <div>
                            <button class="btn-osu-big btn-osu-big--rounded-thin-wide">
                                {{ osu_trans('teams.create.submit') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
