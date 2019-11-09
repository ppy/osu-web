{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
