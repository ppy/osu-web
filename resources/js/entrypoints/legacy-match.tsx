// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Main from 'legacy-match';
import core from 'osu-core-singleton';
import React from 'react';
import { parseJson } from 'utils/json';

core.reactTurbolinks.register('mp-history', () => (
  <Main events={parseJson('json-events')} />
));
