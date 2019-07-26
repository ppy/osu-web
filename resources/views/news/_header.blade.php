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
<div class="osu-page osu-page--header-news">
    <ol class="page-mode page-mode--breadcrumb">
        <li class="page-mode__item">
            <a class="page-mode-link" href="{{ route('news.index') }}">
                {{ trans("layout.menu.{$currentSection}.{$currentAction}") }}

                <span class="page-mode-link__stripe">
                </span>
            </a>
        </li>

        <li class="page-mode__item">
            <a class="page-mode-link page-mode-link--is-active" href="{{ Request::url() }}">
                {{ trans("news.breadcrumbs.{$currentAction}") }}

                <span class="page-mode-link__stripe">
                </span>
            </a>
        </li>
    </ol>
    <div class="osu-page-header osu-page-header--news">
        <h1 class="osu-page-header__title">
            {{ $title }}
        </h1>

        <div class="osu-page-header__actions">
            {!! $actions !!}
        </div>
    </div>
</div>
