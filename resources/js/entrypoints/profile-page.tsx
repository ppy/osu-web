// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton';
import Main from 'profile-page/main';
import * as React from 'react';

core.reactTurbolinks.register('profile-page', (container: HTMLElement) => <Main container={container} />);
