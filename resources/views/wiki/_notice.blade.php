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
@if ($page->isVisible() && $page->locale !== $locale)
    <div class="wiki-notice">
        <div class="wiki-notice__box">
            {{ trans('wiki.show.fallback_translation', ['language' => locale_name($locale)]) }}
        </div>
    </div>
@endif

@if ($page->isLegalTranslation())
    <div class="wiki-notice">
        <div class="wiki-notice__box wiki-notice__box--important">
            {!! trans('wiki.show.translation.legal', [
                'default' => '<a href="'.e(wiki_url($page->path, config('app.fallback_locale'))).'">'.e(trans('wiki.show.translation.default')).'</a>',
            ]) !!}
        </div>
    </div>
@endif

@if ($page->isOutdated())
    <div class="wiki-notice">
        <div class="wiki-notice__box">
            @if ($page->isTranslation())
                {!! trans('wiki.show.translation.outdated', [
                    'default' => '<a href="'.e(wiki_url($page->path, config('app.fallback_locale'))).'">'.e(trans('wiki.show.translation.default')).'</a>',
                ]) !!}
            @else
                {{ trans('wiki.show.incomplete_or_outdated') }}
            @endif
        </div>
    </div>
@elseif ($page->needsCleanup())
    <div class="wiki-notice">
        <div class="wiki-notice__box">
            {{ trans('wiki.show.needs_cleanup_or_rewrite') }}
        </div>
    </div>
@endif
