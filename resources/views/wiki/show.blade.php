{{--
    Copyright 2016 ppy Pty. Ltd.

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

@extends('master', [
    'titleAppend' => $path,
    'title' => null,
])

@section('content')
    <div class="osu-layout__row osu-layout__row--page-compact">
        <div class="osu-page-header osu-page-header--wiki">
            <div class="osu-page-header__title-box">
                @if (present($subtitle))
                    <h2 class="osu-page-header__title osu-page-header__title--small">{{ $subtitle }}</h2>
                @endif

                <h1 class="osu-page-header__title">{{ $title }}</h1>
            </div>
        </div>
    </div>

    <div class="osu-layout__row osu-layout__row--page-compact">
        @if (count($pageLocales) > 1 || (count($pageLocales) === 1 && $pageLocale !== $pageLocales[0]))
            <div class="wiki-language-list">
                <div class="wiki-language-list__header">
                    {{ trans('wiki.show.other_languages') }}:
                </div>

                @foreach ($pageLocales as $locale)
                    @if ($locale === $pageLocale)
                        @continue
                    @endif
                    <a class="wiki-language-list__item" href="?locale={{ $locale }}">
                        {{ App\Libraries\LocaleMeta::nameFor($locale) }}
                    </a>
                @endforeach
            </div>
        @endif

        @if (!empty($pageLocales))
            <div class="wiki-edit">
                <a class="wiki-edit__link" href="{{ $page->editUrl() }}">
                    {{ trans('wiki.show.edit.link') }}
                </a>

                @if (priv_check('WikiPageRefresh')->can())
                    <a class="wiki-edit__link" href="#" data-remote="true" data-method="PUT">
                        {{ trans('wiki.show.edit.refresh') }}
                    </a>
                @endif
            </div>
        @endif

        <div class="wiki-content js-wiki-content">
            @if (present($pageMd))
                {!! Markdown::convertToHtml($pageMd) !!}
            @else
                @if (empty($pageLocales))
                    {{ trans('wiki.show.missing') }}
                @else
                    {{ trans('wiki.show.missing_translation') }}
                @endif
            @endif
        </div>
    </div>
@endsection
