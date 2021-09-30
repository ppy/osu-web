// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { SearchResponse } from 'beatmaps/beatmapset-search';
import { Main } from 'beatmaps/main';
import core from 'osu-core-singleton';
import * as React from 'react';
import { parseJson } from 'utils/json';

core.reactTurbolinks.register('beatmaps', (container: HTMLElement) => {
  const beatmapsets = parseJson<SearchResponse>('json-beatmaps', true);
  if (beatmapsets != null) {
    core.beatmapsetSearchController.initialize(beatmapsets);
  }
  core.beatmapsetSearchController.advancedSearch = container.dataset.advancedSearch === '1';

  // includes an initial search to load the pre-initialized data properly.
  core.beatmapsetSearchController.restoreTurbolinks();

  return <Main availableFilters={parseJson('json-filters')} />;
});
