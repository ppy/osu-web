# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import BeatmapsetCover from 'components/beatmapset-cover'
import Mod from 'components/mod'
import TimeWithTooltip from 'components/time-with-tooltip'
import { route } from 'laroute'
import * as React from 'react'
import { div, a, span, h1, h2 } from 'react-dom-factories'
import { getArtist, getTitle } from 'utils/beatmap-helper'
import { trans } from 'utils/lang'

el = React.createElement

timeFormat = 'LTS'

export class GameHeader extends React.Component

  render: ->
    title = getTitle(@props.beatmapset)
    title += " [#{@props.beatmap.version}]" if @props.beatmap.version

    a
      className: 'mp-history-game__header'
      href: (route 'beatmaps.show', beatmap: @props.beatmap.id) if @props.beatmap.id

      el BeatmapsetCover,
        beatmapset: @props.beatmapset
        modifiers: 'full'
        size: 'cover'

      div
        className: 'mp-history-game__header-overlay'

      div className: 'mp-history-game__stats-box',
        span className: 'mp-history-game__stat',
          el TimeWithTooltip, dateTime: @props.game.start_time, format: timeFormat
          if @props.game.end_time?
            el React.Fragment, null,
              ' - '
              el TimeWithTooltip, dateTime: @props.game.end_time, format: timeFormat
          else
            " #{trans 'matches.match.in-progress'}"
        span className: 'mp-history-game__stat', trans "beatmaps.mode.#{@props.game.mode}"
        span className: 'mp-history-game__stat', trans "matches.game.scoring-type.#{@props.game.scoring_type}"

      div className: 'mp-history-game__metadata-box',
        h1 className: 'mp-history-game__metadata mp-history-game__metadata--title',
          title
        h2 className: 'mp-history-game__metadata mp-history-game__metadata--artist', getArtist(@props.beatmapset)

      div className: 'mp-history-game__mods',
        el(Mod, key: mod, mod: mod) for mod in @props.game.mods

      div
        className: 'mp-history-game__team-type'
        title: trans "matches.match.team-types.#{@props.game.team_type}"
        style:
          backgroundImage: "url(/images/badges/team-types/#{@props.game.team_type}.svg)"
