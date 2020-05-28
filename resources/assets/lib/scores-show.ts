// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Main from 'scores-show/main';

reactTurbolinks.registerPersistent('scores-show', Main, true, () => ({
  score: osu.parseJson('json-show'),
}));
