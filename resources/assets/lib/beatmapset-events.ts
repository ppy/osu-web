// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Events from 'beatmap-discussions/events';

reactTurbolinks.register('beatmap-discussion-events', Events, (container: HTMLElement) => ({
  container,
  discussions: osu.parseJson('json-discussions'),
  events: osu.parseJson('json-events'),
  posts: osu.parseJson('json-posts'),
  users: osu.parseJson('json-users'),
}));
