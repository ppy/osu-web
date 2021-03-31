// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Main from 'news-show/main';

reactTurbolinks.registerPersistent('news-show', Main, true, (container: HTMLElement) => ({
  container,
  post: osu.parseJson('json-show'),
  sidebarMeta: osu.parseJson('json-sidebar'),
}));
