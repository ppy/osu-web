{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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

            <table class="table">
                <tr>
                    <th></th>
                    <th>
                        {{ trans('beatmapset_watches.index.table.title') }}
                    </th>
                    <th>
                        {{ trans('beatmapset_watches.index.table.state') }}
                    </th>
                    <th>
                        {{ trans('beatmapset_watches.index.table.open_issues') }}
                    </th>
                    <th></th>
                </tr>

                @if (count($watches) > 0)
                    @foreach ($watches as $watch)
                        <tr>
                            <td class="beatmapset-watches__col beatmapset-watches__col--cover">
                                <div {!! background_image($watch->beatmapset->coverURL('list'), false) !!} class="beatmapset-watches__cover">
                                </div>
                            </td>
                            <td class="beatmapset-watches__col">
                                <a href="{{ route('beatmapsets.discussion', $watch->beatmapset) }}">
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
                                    title="{{ trans('beatmapset_watches.button.action.to_0') }}"
                                >
                                    <i class="fa fa-trash"></i>
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

            @include('forum._pagination', ['object' => $watches])
        </div>
    </div>
@endsection
