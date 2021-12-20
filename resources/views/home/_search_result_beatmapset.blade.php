{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@foreach ($search->data() as $entry)
    <div class="search-result-entry">
        <div
            class="js-react--beatmapset-panel"
            data-beatmapset-panel="{{ json_encode(['beatmapset' => json_item($entry, 'Beatmapset', ['beatmaps'])]) }}"
        ></div>
    </div>
@endforeach
