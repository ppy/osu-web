// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Events from 'beatmap-discussions/events';
import core from 'osu-core-singleton';
import * as React from 'react';

core.reactTurbolinks.register('beatmap-discussion-events', () => (
  <Events
    events={osu.parseJson('json-events')}
    users={osu.parseJson('json-users')}
  />
));
