// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton';
import * as React from 'react';
import Main from 'user-multiplayer-index/main';

core.reactTurbolinks.register('user-multiplayer-index', true, () => (
  <Main {...osu.parseJson('json-user-multiplayer-index')} />
));
