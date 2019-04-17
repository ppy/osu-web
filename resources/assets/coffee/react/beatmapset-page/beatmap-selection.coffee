###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
#
#    This file is part of osu!web. osu!web is distributed with the hope of
#    attracting more community contributions to the core ecosystem of osu!.
#
#    osu!web is free software: you can redistribute it and/or modify
#    it under the terms of the Affero GNU General Public License version 3
#    as published by the Free Software Foundation.
#
#    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
#    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
#    See the GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###

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
