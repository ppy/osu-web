# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Main } from './changelog-build/main'

reactTurbolinks.registerPersistent 'changelog-build', Main, true, (el) ->
  container: el
  updateStreams: osu.parseJson('json-update-streams')
  build: osu.parseJson('json-build')
