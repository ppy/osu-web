{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

{{-- FIXME: move to user modding history --}}
@section('content')
    @include('layout._page_header_v4')
    <div class="osu-layout__row osu-layout__row--page">
        <div class="beatmapset-activities">
            @if (isset($user))
                <h2>{{ trans('users.beatmapset_activities.title', ['user' => $user->username]) }}</h2>
            @endif

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
                        {{ trans('beatmapset_events.index.form.types') }}
                    </div>
                    <div class="simple-form__checkboxes-overflow">
                        @php
                            if (present($search['params']['user'] ?? null)) {
                                $types = App\Models\BeatmapsetEvent::types('public');
                                if (priv_check('BeatmapDiscussionAllowOrDenyKudosu')->can()) {
                                    $types = array_merge($types, App\Models\BeatmapsetEvent::types('kudosuModeration'));
                                }
                                if (priv_check('BeatmapDiscussionModerate')->can()) {
                                    $types = array_merge($types, App\Models\BeatmapsetEvent::types('moderation'));
                                }
                            } else {
                                $types = App\Models\BeatmapsetEvent::types('all');
                            }
                        @endphp
                        @foreach ($types as $type)
                            <div class="simple-form__checkbox-overflow-container">
                                <label class="simple-form__checkbox simple-form__checkbox--overflow">
                                    @include('objects._switch', [
                                        'checked' => in_array($type, $search['params']['types'], true),
                                        'name' => 'types[]',
                                        'type' => 'checkbox',
                                        'value' => $type,
                                    ])
                                    {{ trans("beatmapset_events.type.{$type}") }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="simple-form__row">
                    <div class="simple-form__label">
                        {{ trans('beatmapset_events.index.form.period') }}
                    </div>

                    <input
                        class="simple-form__input simple-form__input--equal-width"
                        name="min_date"
                        type="date"
                        {{-- set correct baseline for safari --}}
                        placeholder=" "
                        value="{{ $search['params']['min_date'] ?? '' }}"
                    >

                    <span class="simple-form__input-arrow-next">
                        <i class="fas fa-chevron-down"></i>
                    </span>

                    <input
                        class="simple-form__input simple-form__input--equal-width"
                        name="max_date"
                        type="date"
                        {{-- set correct baseline for safari --}}
                        placeholder=" "
                        value="{{ $search['params']['max_date'] ?? '' }}"
                    >
                </div>

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

            <div class='beatmapset-events' id="events">
                <div class='beatmapset-events__title'></div>
                @foreach ($events as $event)
                    @include('beatmapset_events._item', compact('event'))
                @endforeach
            </div>
            @include('objects._pagination_v2', ['object' => $events->fragment('events')])
        </div>
    </div>
@endsection
