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
                Upload
            </h2>
            <div class="simple-form__row">
                <div class="simple-form__label">
                    Files
                </div>
                <input class="simple-form__input" type="file" multiple="1" name="files[]" accept="image/*" />
            </div>

            <div class="simple-form__row simple-form__row--no-label">
                <button class="btn-osu-big btn-osu-big--rounded-thin">
                    Create
                </button>
            </div>
        </form>

        <div class="user-cover-preset-table">
            <div class="user-cover-preset-table__row">
                    @include('objects._switch', ['locals' => [
                        'additionalClass' => '
                            js-user-cover-preset-batch-enable
                            js-user-cover-preset-batch-enable--select-all
                        ',
                        'attributes' => ['data-action' => 'select-all'],
                        'modifiers' => 'grid',
                        'name' => 'select-all',
                    ]])

                <div class="user-cover-preset-table__toolbar">
                    <button
                        class="js-user-cover-preset-batch-enable btn-osu-big btn-osu-big--rounded-small"
                        data-action="enable-selected"
                        type="button"
                    >
                        Enable Selected
                    </button>

                    <button
                        class="js-user-cover-preset-batch-enable btn-osu-big btn-osu-big--rounded-small"
                        data-action="disable-selected"
                        type="button"
                    >
                        Disable Selected
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
                    <div
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
                    </div>

                    <div>
                        <p>
                            <button
                                class="btn-osu-big btn-osu-big--rounded-small"
                                data-url="{{ route('user-cover-presets.update', [
                                    'user_cover_preset' => $item->getKey(),
                                    'active' => $item->active ? '0' : '1',
                                ]) }}"
                                data-method="PUT"
                                data-reload-on-success="1"
                                data-remote="1"
                                title="{{ $isActive ? 'Click to disable' : 'Click to enable' }}"
                            >
                                @if ($isActive)
                                    <span class="fas fa-circle"></span>
                                    Enabled
                                @else
                                    <span class="far fa-circle"></span>
                                    Disabled
                                @endif
                            </button>
                        </p>
                        <p>
                            <form
                                action="{{ route('user-cover-presets.update', $item) }}"
                                enctype="multipart/form-data"
                                method="POST"
                                class="user-cover-preset-replace"
                            >
                                @csrf
                                <input type="hidden" name="_method" value="PUT" />
                                <input type="file" name="file" accept="image/*" required />
                                <button class="btn-osu-big btn-osu-big--rounded-small">
                                    {{ $imageUrl === null ? 'Set Image' : 'Replace Image' }}
                                </button>
                            </form>
                        </p>
                    </div>

                    @if ($imageUrl === null)
                        <p>No Image</p>
                    @else
                        <img class="user-cover-preset-table__image" src="{{ $imageUrl }}" alt="cover preset #{{ $id }}" />
                    @endif
                </div>
            @endforeach
        </table>
    </div>

    @include('layout._extra_js', ['src' => 'js/user-cover-presets.js'])
@endsection
