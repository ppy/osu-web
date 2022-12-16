// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton';
import * as React from 'react';
import Main from 'seasons-show/main';
import MultiplayerListStore from 'stores/multiplayer-list-store';
import { parseJson } from 'utils/json';

core.reactTurbolinks.register('seasons-show', () => {
  const store = new MultiplayerListStore();
  store.updateWithJson(parseJson('json-rooms'));

  return (
    <Main
      currentSeason={parseJson('json-currentSeason')}
      rooms={parseJson('json-rooms')}
      seasons={parseJson('json-seasons')}
      store={store}
    />
  );
});
