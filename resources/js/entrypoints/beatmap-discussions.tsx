// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Main from 'beatmap-discussions/main';
import core from 'osu-core-singleton';
import React from 'react';
import { parseJson } from 'utils/json';


core.reactTurbolinks.register('beatmap-discussions', (container: HTMLElement) => (
  <Main
    beatmapsetSelectorId='json-beatmapset'
    container={container}
    initial={{
      reviews_config: parseJson('json-reviews_config'),
    }}
  />
));
