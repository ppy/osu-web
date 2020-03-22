# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Main } from './beatmap-discussions/main'

reactTurbolinks.registerPersistent 'beatmap-discussions', Main, true, (target) ->
  initial: osu.parseJson 'json-beatmapset-discussion'
  container: target
