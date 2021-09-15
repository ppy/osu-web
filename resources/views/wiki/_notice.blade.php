{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if ($page->isVisible() && $page->locale !== $page->requestedLocale)
    <div class="wiki-notice">
        {{ osu_trans('wiki.show.fallback_translation', ['language' => locale_meta($page->requestedLocale)->name()]) }}
    </div>
@endif

@if ($page->isLegalTranslation())
    <div class="wiki-notice wiki-notice--important">
        {!! osu_trans('wiki.show.translation.legal', [
            'default' => '<a href="'.e(wiki_url($page->path, config('app.fallback_locale'))).'">'.e(osu_trans('wiki.show.translation.default')).'</a>',
        ]) !!}
    </div>
@endif

@if ($page->isOutdated())
    <div class="wiki-notice">
        @if ($page->isTranslation())
            {!! osu_trans('wiki.show.translation.outdated', [
                'default' => '<a href="'.e(wiki_url($page->path, config('app.fallback_locale'))).'">'.e(osu_trans('wiki.show.translation.default')).'</a>',
            ]) !!}
        @else
            {{ osu_trans('wiki.show.incomplete_or_outdated') }}
        @endif
    </div>
@elseif ($page->needsCleanup())
    <div class="wiki-notice">
        {{ osu_trans('wiki.show.needs_cleanup_or_rewrite') }}
    </div>
@elseif ($page->isStub())
    <div class="wiki-notice">
        {{ osu_trans('wiki.show.stub') }}
    </div>
@endif
