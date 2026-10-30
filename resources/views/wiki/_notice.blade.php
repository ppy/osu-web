{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if ($page->isVisible() && $page->locale !== $displayLocale)
    <div class="wiki-notice">
        {{ osu_trans(
            'wiki.show.fallback_translation',
            ['language' => locale_meta($displayLocale)->name()],
            $displayLocale,
        ) }}
    </div>
@endif

@if ($page->isLegalTranslation())
    <div class="wiki-notice wiki-notice--important">
        {!! osu_trans('wiki.show.translation.legal',
            ['default' => tag(
                'a',
                ['href' => wiki_url($page->path, $GLOBALS['cfg']['app']['fallback_locale'])],
                e(osu_trans('wiki.show.translation.default', [], $displayLocale)),
            )],
            $displayLocale,
        ) !!}
    </div>
@endif

@if ($page->isOutdatedTranslation())
    <div class="wiki-notice">
        {!! osu_trans(
            'wiki.show.translation.outdated',
            ['default' => tag(
                'a',
                ['href' => wiki_url($page->path, $GLOBALS['cfg']['app']['fallback_locale'])],
                e(osu_trans('wiki.show.translation.default', [], $displayLocale)),
            )],
            $displayLocale,
        ) !!}
    </div>
@endif

@if ($page->isOutdated())
    <div class="wiki-notice">
        {{ osu_trans('wiki.show.incomplete_or_outdated', [], $displayLocale) }}
    </div>
@elseif ($page->needsCleanup())
    <div class="wiki-notice">
        {{ osu_trans('wiki.show.needs_cleanup_or_rewrite', [], $displayLocale) }}
    </div>
@endif

@if ($page->isStub())
    <div class="wiki-notice">
        {{ osu_trans('wiki.show.stub', [], $displayLocale) }}
    </div>
@endif
