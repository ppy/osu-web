{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    <div class="osu-layout__row osu-layout__row--page-compact osu-layout__row--sm1 osu-layout__row--full t-forum-category-osu">
        <div class="osu-layout__sub-row osu-layout__sub-row--lg1-compact ">
            @include('home._user_header_nav')

            <div class="osu-page-header osu-page-header--home-user js-current-user-cover">
                <div class="osu-page-header__box">
                    <h1 class="osu-page-header__title">
                        {!! trans('beatmapset_watches.index.title_main') !!}
                    </h1>
                </div>

                <div class="osu-page-header__box osu-page-header__box--status">
                    {{-- prevent pushed to the right --}}
                </div>
            </div>
        </div>

        <div class="beatmapset-watches">
            <div class="beatmapset-watches__description">
                {{ trans('beatmapset_watches.index.description') }}
            </div>

            <div class="beatmapset-watches__table-container">
                <table class="table beatmapset-watches__table">
                    <tr class="beatmapset-watches__row">
                        <th class="beatmapset-watches__heading"></th>
                        <th class="beatmapset-watches__heading">
                            {{ trans('beatmapset_watches.index.table.title') }}
                        </th>
                        <th class="beatmapset-watches__heading">
                            {{ trans('beatmapset_watches.index.table.state') }}
                        </th>
                        <th class="beatmapset-watches__heading">
                            {{ trans('beatmapset_watches.index.table.open_issues') }}
                        </th>
                        <th class="beatmapset-watches__heading"></th>
                    </tr>

                    @if (count($watches) > 0)
                        @foreach ($watches as $watch)
                            <tr>
                                <td class="beatmapset-watches__col beatmapset-watches__col--cover">
                                    <a href="{{ route('beatmapsets.discussion', $watch->beatmapset) }}">
                                        <div
                                            {!! background_image($watch->beatmapset->coverURL('list'), false) !!}
                                            class="beatmapset-watches__cover"
                                        ></div>
                                    </a>
                                </td>
                                <td class="beatmapset-watches__col">
                                    <a href="{{ route('beatmapsets.discussion', $watch->beatmapset) }}" class="beatmapset-watches__link">
                                        @if ($watch->isRead())
                                            {{ $watch->beatmapset->title }}
                                        @else
                                            <strong>
                                                {{ $watch->beatmapset->title }}
                                            </strong>
                                        @endif
                                    </a>
                                </td>

                                <td class="beatmapset-watches__col">
                                    {{ $watch->beatmapset->status() }}
                                </td>

                                <td class="beatmapset-watches__col">
                                    {{ $watch->beatmapset->beatmapDiscussions()->openIssues()->count() }}
                                </td>

                                <td class="beatmapset-watches__col">
                                    <button class="btn-circle"
                                        data-remote="true"
                                        data-method="DELETE"
                                        data-url="{{ route('beatmapsets.watches.destroy', $watch->beatmapset) }}"
                                        data-reload-on-success="1"
                                        data-confirm="{{ trans('common.confirmation') }}"
                                        title="{{ trans('common.buttons.watch.to_0') }}"
                                    >
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">
                                {{ trans('beatmapset_watches.index.table.empty') }}
                            </td>
                        </tr>
                    @endif
                </table>
            </div>

            @include('objects._pagination_v2', ['object' => $watches])
        </div>
    </div>
@endsection
