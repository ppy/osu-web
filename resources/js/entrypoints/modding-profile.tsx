// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Main } from 'modding-profile/main';
import core from 'osu-core-singleton';
import React from 'react';
import { parseJson } from 'utils/json';

core.reactTurbolinks.register('modding-profile', (container) => (
  <Main
    beatmaps={parseJson('json-beatmaps')}
    beatmapsets={parseJson('json-beatmapsets')}
    container={container}
    discussions={parseJson('json-discussions')}
    events={parseJson('json-events')}
    extras={parseJson('json-extras')}
    perPage={parseJson('json-perPage')}
    posts={parseJson('json-posts')}
    reviewsConfig={parseJson('json-reviewsConfig')}
    user={parseJson('json-user')}
    users={parseJson('json-users')}
    votes={parseJson('json-votes')}
  />
));
