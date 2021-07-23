// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Main } from 'groups-show/main';
import osu from 'osu-common';
import core from 'osu-core-singleton';
import * as React from 'react';

core.reactTurbolinks.register('groups-show', () => (
  <Main group={osu.parseJson('json-group')} users={osu.parseJson('json-users')} />
));
