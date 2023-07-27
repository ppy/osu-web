// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Main from 'beatmap-discussions-history/main';
import BeatmapsetDiscussionsBundleJson from 'interfaces/beatmapset-discussions-bundle-json';
import core from 'osu-core-singleton';
import React from 'react';
import { parseJson } from 'utils/json';

core.reactTurbolinks.register('beatmap-discussions-history', () => (
  <Main bundle={parseJson<BeatmapsetDiscussionsBundleJson>('json-index')} />
));
