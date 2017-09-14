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
@extends("master")

@section('content')
    <div class="osu-layout__section osu-layout__section--full">
        @include('changelog._changelog_header', [
            'url' => route('changelog.index'),
            'breadcrumb' => trans('changelog.feed_title')
        ])

        <div class="osu-layout__row osu-layout__row--page-compact">
            <div class="changelog">
                @foreach($changelogs as $date => $logs)
                    <p class="changelog__text changelog__text--date">{{ $date }}</p>

                    <div class="changelog__list">
                        @each('changelog._changelog_change', $logs, 'log')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
    @parent

    <script id="json-chart-data" type="application/json">
        {!! json_encode($buildHistory) !!}
    </script>

    <script id="json-chart-config" type="application/json">
        {
            "order": {!! json_encode($chartOrder) !!},
            "isBuild": false
        }
    </script>

    <script id="json-current-stream" type="application/json">
        {!! json_encode($featuredBuild->updateStream->pretty_name); !!}
    </script>
@endsection
