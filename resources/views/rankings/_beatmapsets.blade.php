{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<div class="{{ class_with_modifiers('rankings-beatmapsets', $modifiers ?? null, ['single' => count($beatmapsets) === 1]) }}">
    @foreach ($beatmapsets as $beatmapset)
        <div
            class="js-react u-contents"
            data-beatmapset-panel="{{ json_encode(['beatmapset' => json_item($beatmapset, 'Beatmapset', ['beatmaps'])]) }}"
            data-react="beatmapset-panel"
        >
            <div class="beatmapset-panel beatmapset-panel--size-normal"></div>
        </div>
    @endforeach
</div>
