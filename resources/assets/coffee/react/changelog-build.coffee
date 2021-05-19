# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton'
import { createElement } from 'react'
import { Main } from './changelog-build/main'

core.reactTurbolinks.register 'changelog-build', true, (el) ->
  createElement Main,
    container: el
    updateStreams: osu.parseJson('json-update-streams')
    build: osu.parseJson('json-build')
