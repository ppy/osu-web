# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Main } from './beatmapset-page/main'

reactTurbolinks.registerPersistent 'beatmapset-page', Main, true, (target) ->
  beatmapset: osu.parseJson('json-beatmapset')
  container: target
