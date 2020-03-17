# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { BeatmapIcon } from 'beatmap-icon'
import * as React from 'react'
import { a } from 'react-dom-factories'
el = React.createElement

export class BeatmapSelection extends React.Component
  onClick: (e) =>
    e.preventDefault()

    return if @props.active
    $.publish 'beatmapset:beatmap:set', beatmap: @props.beatmap

  onMouseEnter: (e) =>
    $.publish 'beatmapset:hoveredbeatmap:set', @props.beatmap

  onMouseLeave: (e) =>
    $.publish 'beatmapset:hoveredbeatmap:set', null

  render: ->
    className = 'beatmapset-beatmap-picker__beatmap'
    className += ' beatmapset-beatmap-picker__beatmap--active' if @props.active

    a
      className: className
      onClick: @onClick
      onMouseEnter: @onMouseEnter
      onMouseLeave: @onMouseLeave
      href: BeatmapsetPageHash.generate beatmap: @props.beatmap
      el BeatmapIcon, beatmap: @props.beatmap, modifier: 'beatmapset', showTitle: false
