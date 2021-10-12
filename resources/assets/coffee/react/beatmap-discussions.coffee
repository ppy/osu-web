# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton'
import { createElement } from 'react'
import { parseJson } from 'utils/json'
import { Main } from './beatmap-discussions/main'

core.reactTurbolinks.register 'beatmap-discussions', (container) ->
  createElement Main,
    initial: parseJson 'json-beatmapset-discussion'
    container: container
