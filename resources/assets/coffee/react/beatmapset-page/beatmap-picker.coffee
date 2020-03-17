# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { BeatmapSelection } from './beatmap-selection'
import * as React from 'react'
import { div } from 'react-dom-factories'
el = React.createElement

export BeatmapPicker = ({beatmaps, currentBeatmap}) ->
  div className: 'beatmapset-beatmap-picker',
    for beatmap in beatmaps
      el BeatmapSelection,
        key: beatmap.id
        beatmap: beatmap
        active: currentBeatmap.id == beatmap.id
