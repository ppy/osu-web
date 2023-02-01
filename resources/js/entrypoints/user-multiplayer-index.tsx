// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton';
import * as React from 'react';
import UserMultiplayerHistoryStore from 'stores/user-multiplayer-history-store';
import Main from 'user-multiplayer-index/main';
import { parseJson } from 'utils/json';

core.reactTurbolinks.register('user-multiplayer-index', () => {
  const store = new UserMultiplayerHistoryStore();
  store.updateWithJson(parseJson('json-user-multiplayer-index'));

  return (
    <Main store={store} user={parseJson('json-user')} />
  );
});
