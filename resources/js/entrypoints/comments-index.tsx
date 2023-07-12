// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CommentsIndex from 'comments-index';
import core from 'osu-core-singleton';
import * as React from 'react';

core.reactTurbolinks.register('comments-index', () => (
  <CommentsIndex controllerStateSelector='#json-index' />
));
