// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Main } from 'friends-index/main';

reactTurbolinks.registerPersistent('friends-index', Main, true, (container: HTMLElement) => ({
  friends: osu.parseJson('json-users'),
}));
