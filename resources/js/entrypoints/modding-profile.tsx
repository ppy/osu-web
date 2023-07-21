// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetDiscussionsBundleJsonForModdingProfile } from 'interfaces/beatmapset-discussions-bundle-json';
import Main from 'modding-profile/main';
import core from 'osu-core-singleton';
import React from 'react';
import { parseJson } from 'utils/json';

core.reactTurbolinks.register('modding-profile', () => (
  <Main {...parseJson<BeatmapsetDiscussionsBundleJsonForModdingProfile>('json-bundle')} />
));
