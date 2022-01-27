# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton'
import { createElement } from 'react'
import Tracklist from 'tracklist'
import { parseJson } from 'utils/json'

core.reactTurbolinks.register 'artistTracklist', (container) ->
  createElement Tracklist,
    artist: parseJson(container.dataset.artistSrc)
    tracks: parseJson(container.dataset.src)
