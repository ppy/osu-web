{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    @include('layout._page_header_v4')
    <div class="osu-page osu-page--generic">
        <form
            class="simple-form simple-form--search-box"
            action="{{ route('user-cover-presets.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            <h2 class="simple-form__row simple-form__row--title">
                {{ osu_trans('user_cover_presets.index.create_form.title') }}
            </h2>
            <div class="simple-form__row">
                <div class="simple-form__label">
                    {{ osu_trans('user_cover_presets.index.create_form.files') }}
                </div>
                <input class="simple-form__input" type="file" multiple="1" name="files[]" accept="image/*" />
            </div>

            <div class="simple-form__row simple-form__row--no-label">
                <button class="btn-osu-big btn-osu-big--rounded-thin">
                    {{ osu_trans('user_cover_presets.index.create_form.submit') }}
                </button>
            </div>
        </form>

        <div class="user-cover-preset-table">
            <div class="user-cover-preset-table__row">
                <label>
                    @include('objects._switch', ['locals' => [
                        'additionalClass' => '
                            js-user-cover-preset-batch-enable
                            js-user-cover-preset-batch-enable--select-all
                        ',
                        'attributes' => ['data-action' => 'select-all'],
                        'modifiers' => 'grid',
                        'name' => 'select-all',
                    ]])
                </label>
                <div class="user-cover-preset-table__toolbar">
                    <button
                        class="js-user-cover-preset-batch-enable btn-osu-big btn-osu-big--rounded-small"
                        data-action="enable-selected"
                        type="button"
                    >
                        {{ osu_trans('user_cover_presets.index.batch_enable') }}
                    </button>

                    <button
                        class="js-user-cover-preset-batch-enable btn-osu-big btn-osu-big--rounded-small"
                        data-action="disable-selected"
                        type="button"
                    >
                        {{ osu_trans('user_cover_presets.index.batch_disable') }}
                    </button>
                </div>
            </div>

            @foreach ($items as $item)
                @php
                    $id = $item->getKey();
                    $imageUrl = $item->file()->url();
                    $isActive = $item->active;
                @endphp
                <div
                    class="user-cover-preset-table__row user-cover-preset-table__row--item"
                    id="cover-{{ $id }}"
                >
                    {{-- wrap in u-contents because shift-click on label doesn't trigger click on the checkbox --}}
                    <label
                        class="u-contents js-user-cover-preset-batch-enable"
                        data-action="select"
                    >
                        @include('objects._switch', ['locals' => [
                            'additionalClass' => 'js-user-cover-preset-batch-enable--checkbox',
                            'attributes' => [
                                'data-id' => $id,
                            ],
                            'modifiers' => 'grid',
                            'name' => 'ids[]',
                        ]])
                    </label>

                    <div>
                        <form
                            action="{{ route('user-cover-presets.update', [
                                'user_cover_preset' => $item->getKey(),
                                'active' => $item->active ? '0' : '1',
                            ]) }}"
                            class="u-contents"
                            data-reload-on-success="1"
                            method="POST"
                        >
                            <input type="hidden" name="_method" value="PUT" />
                            <button
                                class="btn-osu-big btn-osu-big--rounded-small"
                                title="{{ osu_trans('user_cover_presets.index.item.'.(
                                    $isActive ? 'click_to_disable' : 'click_to_enable'
                                )) }}"
                            >
                                @if ($isActive)
                                    <span class="fas fa-circle"></span>
                                    {{ osu_trans('user_cover_presets.index.item.enabled') }}
                                @else
                                    <span class="far fa-circle"></span>
                                    {{ osu_trans('user_cover_presets.index.item.disabled') }}
                                @endif
                            </button>
                        </form>

                        <form
                            action="{{ route('user-cover-presets.update', $item) }}"
                            class="user-cover-preset-replace"
                            enctype="multipart/form-data"
                            method="POST"
                            data-reload-on-success="1"
                        >
                            @csrf
                            <input type="hidden" name="_method" value="PUT" />
                            <input class="user-cover-preset-replace__input" type="file" name="file" accept="image/*" required />
                            <button class="btn-osu-big btn-osu-big--rounded-small">
                                {{ osu_trans('user_cover_presets.index.item.'.(
                                    $imageUrl === null ? 'image_store' : 'image_update'
                                )) }}
                            </button>
                        </form>
                    </div>

                    @if ($imageUrl === null)
                        <p>{{ osu_trans('user_cover_presets.index.item.no_image') }}</p>
                    @else
                        <img class="user-cover-preset-table__image" src="{{ $imageUrl }}" alt="" />
                    @endif
                </div>
            @endforeach
        </table>
    </div>

    @include('layout._extra_js', ['src' => 'js/user-cover-presets.js'])
@endsection
