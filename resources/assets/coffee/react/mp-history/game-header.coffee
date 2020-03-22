# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Mods } from 'mods'
import * as React from 'react'
import { div, a, span, h1, h2 } from 'react-dom-factories'
import TimeWithTooltip from 'time-with-tooltip'

el = React.createElement

timeFormat = 'LTS'

export class GameHeader extends React.Component

  render: ->
    title = @props.beatmapset.title
    title += " [#{@props.beatmap.version}]" if @props.beatmap.version

    a
      className: 'mp-history-game__header'
      href: (laroute.route 'beatmaps.show', beatmap: @props.beatmap.id) if @props.beatmap.id
      style:
        backgroundImage: osu.urlPresence(@props.beatmapset.covers.cover)

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
            " #{osu.trans 'multiplayer.match.in-progress'}"
        span className: 'mp-history-game__stat', osu.trans "beatmaps.mode.#{@props.game.mode}"
        span className: 'mp-history-game__stat', osu.trans "multiplayer.game.scoring-type.#{@props.game.scoring_type}"

      div className: 'mp-history-game__metadata-box',
        h1 className: 'mp-history-game__metadata mp-history-game__metadata--title',
          title
        h2 className: 'mp-history-game__metadata mp-history-game__metadata--artist', @props.beatmapset.artist

      div className: 'mp-history-game__mods-box',
        el Mods,
          mods: @props.game.mods
          modifiers: ['large', 'reversed']

      div
        className: 'mp-history-game__team-type'
        title: osu.trans "multiplayer.match.team-types.#{@props.game.team_type}"
        style:
          backgroundImage: "url(/images/badges/team-types/#{@props.game.team_type}.svg)"
