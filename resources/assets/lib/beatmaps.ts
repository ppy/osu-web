// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Main } from 'beatmaps/main';
import core from 'osu-core-singleton';

reactTurbolinks.registerPersistent('beatmaps', Main, true, (container: HTMLElement) => {
  const beatmapsets = osu.parseJson('json-beatmaps', true);
  if (beatmapsets != null) {
    core.beatmapsetSearchController.initialize(beatmapsets);
  }
  core.beatmapsetSearchController.advancedSearch = container.dataset.advancedSearch === '1';

  // includes an initial search to load the pre-initialized data properly.
  core.beatmapsetSearchController.restoreTurbolinks();

  return {
    availableFilters: osu.parseJson('json-filters'),
  };
});
