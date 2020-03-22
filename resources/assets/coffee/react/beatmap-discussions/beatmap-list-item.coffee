# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { BeatmapIcon } from 'beatmap-icon'
import * as React from 'react'
import { div, i } from 'react-dom-factories'
el = React.createElement

bn = 'beatmap-list-item'

export BeatmapListItem = (props) ->
  topClasses = bn
  topClasses += " #{bn}--large" if props.large

  version = props.beatmap.version

  if props.beatmap.deleted_at?
    topClasses += " #{bn}--deleted"
    version += " [#{osu.trans 'beatmap_discussions.index.deleted_beatmap'}]"

  div
    className: topClasses

    div className: "#{bn}__col",
      el BeatmapIcon,
        beatmap: props.beatmap
        modifier: "#{'large' if props.large}"

    div className: "#{bn}__col #{bn}__col--main",
      div className: 'u-ellipsis-overflow',
        version

    if props.withButton?
      div className: "#{bn}__col",
        i className: "fas fa-chevron-#{props.withButton}"

    if props.count?
      div className: "#{bn}__col",
        div className: "#{bn}__counter", props.count
