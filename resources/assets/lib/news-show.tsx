// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Main from 'news-show/main';
import * as osu from 'osu-common';
import core from 'osu-core-singleton';
import * as React from 'react';

core.reactTurbolinks.register('news-show', (container: HTMLElement) => (
  <Main
    container={container}
    post={osu.parseJson('json-show')}
    sidebarMeta={osu.parseJson('json-sidebar')}
  />
));
