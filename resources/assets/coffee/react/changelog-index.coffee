# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Main } from './changelog-index/main'

reactTurbolinks.registerPersistent 'changelog-index', Main, true, (el) ->
  container: el
  updateStreams: osu.parseJson('json-update-streams')
  data: osu.parseJson('json-index')
