# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton'
import { createElement } from 'react'
import { parseJson } from 'utils/json'
import { Main } from 'changelog-index/main'

core.reactTurbolinks.register 'changelog-index', (container) ->
  createElement Main,
    container: container
    updateStreams: parseJson('json-update-streams')
    data: parseJson('json-index')
