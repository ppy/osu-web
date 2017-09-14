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

<div class="osu-layout__row osu-layout__row--changelog-header">
    <ol class="page-mode page-mode--breadcrumb">
        <li class="page-mode__item">
            <a class="page-mode-link" href="{{ route('changelog.index') }}">
                {{ trans("layout.menu.home.changelog-index") }}

                <span class="page-mode-link__stripe">
                </span>
            </a>
        </li>

        <li class="page-mode__item">
            <a class="page-mode-link page-mode-link--is-active" href="{{ $url }}">
                {{ $breadcrumb }}

                <span class="page-mode-link__stripe">
                </span>
            </a>
        </li>
    </ol>

    <div class="changelog-header">
        <div class="changelog-header__builds-box">
            <div class="changelog-header__builds">
                @include('changelog._changelog_build', ['build' => $featuredBuild, 'featured' => true])
            </div>
            <div class="changelog-header__builds">
                @foreach($builds as $build)
                    @include('changelog._changelog_build', ['build' => $build, 'featured' => false])
                @endforeach
            </div>
        </div>
    </div>
    <div class="changelog-chart js-changelog-chart"></div>
</div>
