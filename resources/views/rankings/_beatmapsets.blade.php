{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<div class="rankings-beatmapsets">
    <div class="osu-layout__col-container osu-layout__col-container--with-gutter">
        @foreach ($beatmapsets as $beatmapset)
            <div class="osu-layout__col osu-layout__col--sm-6">
                <div
                    class="js-react--beatmapset-panel"
                    data-beatmapset-panel="{{ json_encode(['beatmapset' => json_item($beatmapset, 'Beatmapset', ['beatmaps'])]) }}"
                ></div>
            </div>
        @endforeach
    </div>
</div>
