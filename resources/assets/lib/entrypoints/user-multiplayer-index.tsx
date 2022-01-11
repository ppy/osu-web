// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton';
import * as React from 'react';
import { Stores } from 'user-multiplayer-history-context';
import Main from 'user-multiplayer-index/main';
import { parseJson } from 'utils/json';

core.reactTurbolinks.register('user-multiplayer-index', () => {
  const stores = new Stores();
  stores.updateWithJson(parseJson('json-user-multiplayer-index'));

  return (
    <Main stores={stores} user={parseJson('json-user')} />
  );
});
