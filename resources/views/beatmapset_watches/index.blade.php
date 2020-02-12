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
@extends('master', [
    'currentSection' => 'home',
])

@section('content')
    @include('home._user_header_default', ['title' => trans('beatmapset_watches.index.title_compact')])

    <div class="osu-page osu-page--full osu-page--generic">
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
                                    {{ trans("beatmapsets.show.status.{$watch->beatmapset->status()}") }}
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
