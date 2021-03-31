// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Main from 'news-index/main';

reactTurbolinks.registerPersistent('news-index', Main, true, (container: HTMLElement) => ({
  container,
  data: osu.parseJson('json-index'),
}));
