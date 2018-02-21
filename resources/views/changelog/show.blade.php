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
            'url' => route('changelog.show', ['build' => $activeBuild->version]),
            'breadcrumb' => $activeBuild->displayVersion().' ('.$activeBuild->updateStream->pretty_name.')'
        ])

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

                @if(!Auth::check() || !Auth::user()->isSupporter())
                    <div class="supporter-promo">
                       <div class="supporter-promo__pippi">
                            <div class="supporter-promo__heart"></div>
                       </div>
                       <div class="supporter-promo__text-box">
                            <h2 class="supporter-promo__heading">{{ trans('changelog.support.heading') }}</h2>

                            <div>
                                <p class="supporter-promo__text">
                                    {!! trans('changelog.support.text_1', ['link' =>
                                        link_to(route('support-the-game'), trans('changelog.support.text_1_link'), ['class' => 'supporter-promo__text supporter-promo__text--link'])
                                    ]) !!}
                                </p>
                                <p class="supporter-promo__text supporter-promo__text--small">{{ trans('changelog.support.text_2') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

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
