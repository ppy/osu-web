// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import groupStore from 'group-history/group-store';
import GroupHistoryJson from 'group-history/json';
import Main from 'group-history/main';
import core from 'osu-core-singleton';
import * as React from 'react';
import { parseJson } from 'utils/json';

core.reactTurbolinks.register('group-history', () => {
  const json: GroupHistoryJson = parseJson('json-group-history');

  groupStore.updateMany(json.groups);

  return <Main cursorString={json.cursor_string} events={json.events} />;
});
