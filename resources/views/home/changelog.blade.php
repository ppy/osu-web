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
        <div class="osu-layout__row osu-layout__row--page-compact osu-layout__row--changelog-header">
            <div class="changelog-header">
                <div class="changelog-header__streams-box">
                    <div class="changelog-header__streams">
                        @include('home._changelog_stream', ['stream' => $featuredStream, 'featured' => true])
                    </div>
                    <div class="changelog-header__streams">
                        @foreach($streams as $stream)
                            @include('home._changelog_stream', ['stream' => $stream, 'featured' => false])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="osu-layout__row osu-layout__row--page-compact">
            <div class="changelog">
                @foreach($changelogs as $date => $logs)
                    <p class="changelog__text changelog__text--date">{{ $date }}</p>
                    @if ($build !== null)
                        <p class="changelog__text changelog__text--build">{{ $build->version }}</p>
                    @endif

                    <div class="changelog__list">
                        @if (count($logs) === 0)
                            @include('home._changelog_change', ['log' => placeholder_change()])
                        @else
                            @each('home._changelog_change', $logs, 'log')
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
