{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', ['titlePrepend' => trans('beatmapset_watches.index.title_compact')])

@section('content')
    @include('home._user_header_default', ['themeOverride' => 'settings'])

    <div class="osu-page osu-page--generic osu-page--full">
        @include('follows._subtypes')

        <div class="grid-items">
            <div class="counter-box counter-box--info">
                <div class="counter-box__title">
                    {{ trans('beatmapset_watches.index.counts.total') }}
                </div>
                <div class="counter-box__count">
                    {{ i18n_number_format($totalCount) }}
                </div>
            </div>

            <div class="counter-box counter-box--info">
                <div class="counter-box__title">
                    {{ trans('beatmapset_watches.index.counts.unread') }}
                </div>
                <div class="counter-box__count">
                    {{ i18n_number_format($unreadCount) }}
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
                        <th class="beatmapset-watches__heading">
                            {{ trans('beatmapset_watches.index.table.last_update') }}
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
                                    {{ trans("beatmapsets.show.status.{$watch->beatmapset->status()}") }}
                                </td>

                                <td class="beatmapset-watches__col">
                                    {{ optional($openIssues[$watch->beatmapset_id] ?? null)->open_count ?? 0 }}
                                </td>

                                <td class="beatmapset-watches__col">
                                    @php
                                        $lastNotified = $watch->last_notified;
                                    @endphp
                                    @if ($lastNotified !== null)
                                        {!! timeago($lastNotified) !!}
                                    @endif
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
                            <td colspan="6">
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
