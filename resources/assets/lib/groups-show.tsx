// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Main } from 'groups-show/main';

reactTurbolinks.registerPersistent('groups-show', Main, true, (container: HTMLElement) => ({
  group: osu.parseJson('json-group'),
  users: osu.parseJson('json-users'),
}));
