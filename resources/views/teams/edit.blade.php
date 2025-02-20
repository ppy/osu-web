{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Models\Team;

    $imageTypeAccept = implode(',', array_map(
        image_type_to_mime_type(...),
        App\Libraries\ImageProcessor::ALLOWED_TYPES,
    ));
@endphp
@extends('master')

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'backgroundImage' => $team->header()->url(),
        'links' => App\Http\Controllers\TeamsController::pageLinks('edit', $team),
        'theme' => 'team',
    ]])

    <form
        method="POST"
        action="{{ route('teams.update', ['team' => $team->getKey()]) }}"
        enctype="multipart/form-data"
        class="osu-page osu-page--generic-compact"
        data-reload-on-success="1"
    >
        @csrf
        <input name="_method" value="PUT" type="hidden" />

        <div class="user-profile-pages user-profile-pages--no-tabs">
            <div class="page-extra">
                <h2 class="title title--page-extra-small title--page-extra-small-top">
                    {{ osu_trans('teams.edit.settings.title') }}
                </h2>

                <div class="team-settings">
                    <div class="team-settings__item">
                        <label class="input-container">
                            <span class="input-container__label">
                                {{ osu_trans('model_validation.team.attributes.url') }}
                            </span>
                            <input
                                name="team[url]"
                                class="input-text"
                                value="{{ $team->url }}"
                            />
                        </label>
                    </div>

                    <div class="team-settings__item">
                        <label class="input-container input-container--select">
                            <span class="input-container__label">
                                {{ osu_trans('model_validation.team.attributes.default_ruleset_id') }}
                            </span>
                            <select
                                name="team[default_ruleset_id]"
                                class="input-text"
                                value="{{ $team->default_ruleset_id }}"
                            >
                                @foreach (App\Models\Beatmap::MODES as $rulesetName => $rulesetId)
                                    <option
                                        value="{{ $rulesetId }}"
                                        @if ($rulesetId === $team->default_ruleset_id)
                                            selected
                                        @endif
                                    >
                                        {{ osu_trans("beatmaps.mode.{$rulesetName}") }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <span class="team-settings__help">
                            {{ osu_trans('teams.edit.settings.default_ruleset_help') }}
                        </span>
                    </div>

                    <div class="team-settings__item">
                        <label class="input-container input-container--select">
                            <span class="input-container__label">
                                {{ osu_trans('model_validation.team.attributes.is_open') }}
                            </span>
                            @php
                                $currentIsOpen = (int) $team->is_open;
                            @endphp
                            <select
                                name="team[is_open]"
                                class="input-text"
                                value="{{ $currentIsOpen }}"
                            >
                                @foreach ([1, 0] as $isOpen)
                                    <option
                                        value="{{ $isOpen }}"
                                        @if ($currentIsOpen === $isOpen)
                                            selected
                                        @endif
                                    >
                                        {{ osu_trans("teams.edit.settings.application_state.state_{$isOpen}") }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <span class="team-settings__help">
                            {{ osu_trans('teams.edit.settings.application_help') }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="page-extra">
                <h2 class="title title--page-extra-small title--page-extra-small-top">
                    {{ osu_trans('teams.edit.header.title') }}
                </h2>
                <div class="team-settings">
                    <div class="team-settings__item">
                        <img
                            class="team-settings__image"
                            src="{{ $team->header()->url() }}"
                        >
                        <span></span>
                        <label class="input-container">
                            <span class="input-container__label">
                                {{ osu_trans('teams.edit.header.label') }}
                            </span>
                            <input accept="{{ $imageTypeAccept }}" class="input-text" type="file" name="team[header]">
                        </label>
                        <span class="team-settings__help">
                            @php
                                [$width, $height] = array_map(i18n_number_format(...), Team::HEADER_MAX_DIMENSIONS);
                            @endphp
                            {{ osu_trans('teams.edit.settings.header_help', compact('height', 'width')) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="page-extra">
                <h2 class="title title--page-extra-small title--page-extra-small-top">
                    {{ osu_trans('teams.edit.flag.title') }}
                </h2>
                <div class="team-settings">
                    <div class="team-settings__item">
                        <img
                            class="team-settings__image"
                            srcset="{{ $team->flag()->url() }} 2x"
                        >
                        <span></span>
                        <label class="input-container">
                            <span class="input-container__label">
                                {{ osu_trans('teams.edit.flag.label') }}
                            </span>
                            <input accept="{{ $imageTypeAccept }}" class="input-text" type="file" name="team[flag]">
                        </label>
                        <span class="team-settings__help">
                            @php
                                [$width, $height] = array_map(i18n_number_format(...), Team::FLAG_MAX_DIMENSIONS);
                            @endphp
                            {{ osu_trans('teams.edit.settings.flag_help', compact('height', 'width')) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="page-extra">
                <h2 class="title title--page-extra-small title--page-extra-small-top">
                    {{ osu_trans('teams.edit.description.title') }}
                </h2>

                <div class="team-settings">
                    <div class="team-settings__item team-settings__item--description">
                        <label class="input-container">
                            <span class="input-container__label">
                                {{ osu_trans('teams.edit.description.label') }}
                            </span>
                            <div class="input-text input-text--bbcode">
                                <textarea
                                    name="team[description]"
                                    class="input-text__bbcode-textarea js-post-preview--auto js-bbcode-body"
                                >{{ $team->description }}</textarea>
                                @include('forum._post_toolbar')
                            </div>
                        </label>

                        <div class="team-settings__description-preview u-fancy-scrollbar">
                            <div class="team-settings-description-preview js-post-preview--preview">
                                {!! $team->descriptionHtml() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-extra-container">
                <div class="page-extra">
                    <div class="team-settings">
                        <div class="team-settings__item team-settings__item--buttons">
                            <div>
                                <a
                                    class="btn-osu-big btn-osu-big--danger btn-osu-big--rounded-thin"
                                    data-turbo-confirm="{{ osu_trans('common.confirmation') }}"
                                    data-turbo-method="DELETE"
                                    href="{{ route('teams.destroy', $team) }}"
                                >
                                    {{ osu_trans('teams.show.bar.destroy') }}
                                </a>
                            </div>

                            <div class="team-settings__buttons">
                                <button class="btn-osu-big btn-osu-big--rounded-thin">
                                    {{ osu_trans('common.buttons.save') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
