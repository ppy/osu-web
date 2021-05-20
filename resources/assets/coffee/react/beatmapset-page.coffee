# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton'
import { createElement } from 'react'
import { Main } from './beatmapset-page/main'

core.reactTurbolinks.register 'beatmapset-page', true, (target) ->
  createElement Main,
    beatmapset: osu.parseJson('json-beatmapset')
    container: target
