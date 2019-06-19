/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import { controller } from 'beatmaps/controller';
import { Main } from 'beatmaps/main';
import core from 'osu-core-singleton';

const store = core.dataStore.beatmapSearchStore;

reactTurbolinks.registerPersistent('beatmaps', Main, true, () => {
  const beatmapsets = osu.parseJson('json-beatmaps', true);
  if (beatmapsets != null) {
    store.initialize(controller.filters, beatmapsets);
  }

  return {
    availableFilters: osu.parseJson('json-filters'),
  };
});
