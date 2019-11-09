{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if ($page->get() !== null && $page->locale !== $page->requestedLocale)
    <div class="wiki-notice">
        <div class="wiki-notice__box">
            {{ trans('wiki.show.fallback_translation', ['language' => locale_name($page->requestedLocale)]) }}
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
                {!! trans('wiki.show.incomplete_or_outdated') !!}
            @endif
        </div>
    </div>
@endif
