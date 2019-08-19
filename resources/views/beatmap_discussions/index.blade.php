{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

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
@extends('master')

{{-- FIXME: move to user modding history --}}
@section('content')
    <div class="osu-layout__row osu-layout__row--page">
        <div class="beatmapset-activities">
            @if (isset($user))
                <h2>{{ trans('users.beatmapset_activities.title', ['user' => $user->username]) }}</h2>
            @endif

            <h3>{{ trans('beatmap_discussions.index.title') }}</h3>

            <form class="simple-form simple-form--search-box">
                <h2 class="simple-form__row simple-form__row--title">
                    {{ trans('beatmap_discussions.index.form._') }}
                </h2>
                @if ($showUserSearch ?? true)
                    <label class="simple-form__row">
                        <div class="simple-form__label">
                            {{ trans('beatmap_discussions.index.form.username') }}
                        </div>

                        <input
                            class="simple-form__input"
                            name="user"
                            value="{{ $search['params']['user'] ?? '' }}"
                        >
                    </label>
                @endif

                <div class="simple-form__row">
                    <div class="simple-form__label">
                        {{ trans('beatmap_discussions.index.form.types') }}
                    </div>
                    <div class="simple-form__checkboxes-inline">
                        @foreach (array_keys(App\Models\BeatmapDiscussion::MESSAGE_TYPES) as $type)
                            <label class="simple-form__checkbox simple-form__checkbox--inline">
                                @include('objects._checkbox', [
                                    'name' => 'message_types[]',
                                    'value' => $type,
                                    'checked' => in_array($type, $search['params']['message_types'], true),
                                ])
                                {{ trans("beatmaps.discussions.message_type.{$type}") }}
                            </label>
                        @endforeach
                    </div>
                </div>

                @if (priv_check('BeatmapDiscussionModerate')->can())
                    <div class="simple-form__row simple-form__row--no-label">
                        <label class="simple-form__checkbox">
                            @include('objects._checkbox', [
                                'name' => 'with_deleted',
                                'value' => 1,
                                'checked' => $search['params']['with_deleted']
                            ])
                            {{ trans('beatmap_discussions.index.form.deleted') }}
                        </label>
                    </div>
                @endif

                <div class="simple-form__row simple-form__row--no-label">
                    <button class="btn-osu-big btn-osu-big--rounded" type="submit">
                        <span class="btn-osu-big__content">
                            <span class="btn-osu-big__left">
                                {{ trans('common.buttons.search') }}
                            </span>
                            <span class="btn-osu-big__icon btn-osu-big__icon--normal">
                                <i class="fas fa-search"></i>
                            </span>
                        </span>
                    </button>
                </div>
            </form>

            <div class="beatmap-discussions__discussion">
                @foreach ($discussions as $discussion)
                    @include('beatmap_discussions._item', compact('discussion'))
                @endforeach
            </div>

            @include('objects._pagination_v2', ['object' => $discussions])
        </div>
    </div>
@endsection
