// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DiscussionsState from 'beatmap-discussions/discussions-state';
import Main from 'beatmap-discussions/main';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import core from 'osu-core-singleton';
import React from 'react';
import { parseJson } from 'utils/json';

function parseJsonString<T>(json?: string) {
  if (json == null) return;
  return JSON.parse(json) as T;
}

core.reactTurbolinks.register('beatmap-discussions', (container: HTMLElement) => {
  // using DiscussionsState['beatmapset'] as type cast to force errors if it doesn't match with props since the beatmapset is from discussionsState.
  const beatmapset = parseJsonString<DiscussionsState['beatmapset']>(container.dataset.beatmapset)
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
