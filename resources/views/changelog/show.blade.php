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
        @include('changelog._changelog_header')

        <div class="osu-layout__row osu-layout__row--page-compact">
            <div class="changelog">
                <p class="changelog__text changelog__text--date">{{ i18n_date($activeBuild->date) }}</p>

                <p class="changelog__text changelog__text--build">
                    @if ($activeBuild->versionPrevious() !== null)
                        <a
                            class="changelog__build-link"
                            href="{{ route('changelog.show', ['build' => $activeBuild->versionPrevious()->version]) }}"
                            title="{{ $activeBuild->versionPrevious()->displayVersion() }}"
                        >
                            <i class="fa fa-angle-double-left"></i>
                        </a>
                    @else
                        <span class="changelog__build-link changelog__build-link--disabled">
                            <i class="fa fa-angle-double-left"></i>
                        </span>
                    @endif

                    {{ $activeBuild->displayVersion() }} ({{ $activeBuild->updateStream->pretty_name }})

                    @if ($activeBuild->versionNext() !== null)
                        <a
                            class="changelog__build-link"
                            href="{{ route('changelog.show', ['build' => $activeBuild->versionNext()->version]) }}"
                            title="{{ $activeBuild->versionNext()->displayVersion() }}"
                        >
                            <i class="fa fa-angle-double-right"></i>
                        </a>
                    @else
                        <span class="changelog__build-link changelog__build-link--disabled">
                            <i class="fa fa-angle-double-right"></i>
                        </span>
                    @endif
                </p>

                <div class="changelog__list">
                    @each('changelog._changelog_change', $changelogs, 'log')
                </div>

                <div
                    class="changelog__disqus js-turbolinks-disqus"
                    data-turbolinks-disqus="{{ json_encode([
                        'identifier' => $activeBuild->disqusId(),
                        'title' => $activeBuild->disqusTitle(),
                    ]) }}"
                ></div>
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
            "isBuild": true
        }
    </script>

    <script id="json-current-stream" type="application/json">
        {!! json_encode($activeBuild->updateStream->pretty_name); !!}
    </script>
@endsection
