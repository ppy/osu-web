// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import MultiplayerList from 'components/multiplayer-list';
import { route } from 'laroute';
import core from 'osu-core-singleton';
import * as React from 'react';
import MultiplayerListStore from 'stores/multiplayer-list-store';
import { parseJson } from 'utils/json';

core.reactTurbolinks.register('seasons-show-list', () => {
  const season: {id: number} = parseJson('json-season');
  const store = new MultiplayerListStore();
  store.updateWithJson(parseJson('json-rooms'));

  return (
    <MultiplayerList showMoreRoute={route('seasons.show', { season: season.id })} store={store} />
  );
});
