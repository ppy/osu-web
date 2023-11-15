// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Main from 'beatmap-discussions/main';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import core from 'osu-core-singleton';
import React from 'react';
import BeatmapsetDiscussionsShowStore from 'stores/beatmapset-discussions-show-store';
import { parseJson } from 'utils/json';

function parseJsonString<T>(json?: string) {
  if (json == null) return;
  return JSON.parse(json) as T;
}

core.reactTurbolinks.register('beatmap-discussions', (container: HTMLElement) => {
  // TODO: avoid reparsing/loading everything on browser navigation for better performance.
  const beatmapset = parseJsonString<BeatmapsetDiscussionsShowStore['beatmapset']>(container.dataset.beatmapset)
    ?? parseJson<BeatmapsetWithDiscussionsJson>('json-beatmapset');
  return (
    <Main
      container={container}
      initial={{
        beatmapset,
        reviews_config: parseJson('json-reviews_config'),
      }}
    />
  );
});
