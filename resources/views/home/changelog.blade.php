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
            <ol class="page-mode page-mode--breadcrumb">
                <li class="page-mode__item">
                    <a class="page-mode-link" href="{{ route('changelog') }}">
                        {{ trans("layout.menu.{$current_section}.{$current_action}") }}

                        <span class="page-mode-link__stripe">
                        </span>
                    </a>
                </li>

                <li class="page-mode__item">
                    @if (isset($build))
                        <a class="page-mode-link page-mode-link--is-active" href="{{ route('changelog', ['build' => $build->version]) }}">
                            {{ $build->displayVersion() }} ({{ $build->updateStream->pretty_name }})

                            <span class="page-mode-link__stripe">
                            </span>
                        </a>
                    @else
                        <a class="page-mode-link page-mode-link--is-active" href="{{ route('changelog') }}">
                            {{ trans('changelog.feed_title') }}

                            <span class="page-mode-link__stripe">
                            </span>
                        </a>
                    @endif
                </li>
            </ol>

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

                    @if (isset($build))
                        <p class="changelog__text changelog__text--build">
                            @if ($build->versionPrevious() !== null)
                                <a
                                    class="changelog__build-link"
                                    href="{{ route('changelog', ['build' => $build->versionPrevious()->version]) }}"
                                    title="{{ $build->versionPrevious()->displayVersion() }}"
                                >
                                    <i class="fa fa-angle-double-left"></i>
                                </a>
                            @else
                                <span class="changelog__build-link changelog__build-link--disabled">
                                    <i class="fa fa-angle-double-left"></i>
                                </span>
                            @endif

                            {{ $build->displayVersion() }} ({{ $build->updateStream->pretty_name }})

                            @if ($build->versionNext() !== null)
                                <a
                                    class="changelog__build-link"
                                    href="{{ route('changelog', ['build' => $build->versionNext()->version]) }}"
                                    title="{{ $build->versionNext()->displayVersion() }}"
                                >
                                    <i class="fa fa-angle-double-right"></i>
                                </a>
                            @else
                                <span class="changelog__build-link changelog__build-link--disabled">
                                    <i class="fa fa-angle-double-right"></i>
                                </span>
                            @endif
                        </p>
                    @endif

                    <div class="changelog__list">
                        @php
                            if (count($logs) === 0) {
                                $logs = [App\Models\Changelog::placeholder()];
                            }
                        @endphp

                        @each('home._changelog_change', $logs, 'log')
                    </div>
                @endforeach

                @if (isset($build))
                    <div
                        class="changelog__disqus js-turbolinks-disqus"
                        data-turbolinks-disqus="{{ json_encode([
                            'identifier' => $build->disqusId(),
                            'title' => $build->disqusTitle(),
                        ]) }}"
                    ></div>
                @endif
            </div>
        </div>
    </div>
@endsection
