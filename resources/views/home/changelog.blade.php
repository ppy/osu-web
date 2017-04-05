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

@php
$lastBuild = null;
@endphp

@section('content')
    <div class="osu-layout__section osu-layout__section--full">
        <div class="osu-layout__row osu-layout__row--page-compact">
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
            <div class="changelog-chart">
                <!-- WIP  -->
                <iframe src="https://app.datadoghq.com/graph/embed?token=66b00a54d1bed990e50dba1c1c534741e292b51615d440c0ad591f154980c2be&amp;height=160&amp;width=600&amp;legend=false" style="border-radius: 5px" height="130" frameborder="0" width="600"></iframe>
            </div>
        </div>

        <div class="osu-layout__row osu-layout__row--page-compact">
            <div class="changelog">
                @foreach($changelogs as $date => $logs)
                    <p class="changelog__text changelog__text--date">{{ Carbon\Carbon::parse($date)->format('F j, Y') }}</p>
                    <p class="changelog__text changelog__text--build">{{$logs[0]->build}}</p>

                    <div class="changelog__list">
                        @foreach($logs as $log)
                            <div class="changelog__change changelog-change">
                                <div class="changelog-change__left">
                                    <span class="changelog-change__icon fa fa-{{ $log->prefix }}" title={{ trans('changelog.prefixes.'.$log->tooltip) }}></span>
                                    <a href="{{route('users.show', ['user' => $log->user_id])}}" class="changelog-change__username">{{ $log->user->username }}</a>
                                </div>
                                <div class="changelog-change__right {{ $log->major === 1 ? 'changelog-change__right--major' : '' }}">
                                    {{ $log->category }}: {{ $log->message }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
