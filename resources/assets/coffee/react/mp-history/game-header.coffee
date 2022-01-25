# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute'
import Mod from 'mod'
import * as React from 'react'
import { div, a, span, h1, h2 } from 'react-dom-factories'
import TimeWithTooltip from 'time-with-tooltip'
import { getArtist, getTitle } from 'utils/beatmap-helper'

el = React.createElement

timeFormat = 'LTS'

export class GameHeader extends React.Component

  render: ->
    title = getTitle(@props.beatmapset)
    title += " [#{@props.beatmap.version}]" if @props.beatmap.version

    a
      className: 'mp-history-game__header'
      href: (route 'beatmaps.show', beatmap: @props.beatmap.id) if @props.beatmap.id
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
            " #{osu.trans 'matches.match.in-progress'}"
        span className: 'mp-history-game__stat', osu.trans "beatmaps.mode.#{@props.game.mode}"
        span className: 'mp-history-game__stat', osu.trans "matches.game.scoring-type.#{@props.game.scoring_type}"

      div className: 'mp-history-game__metadata-box',
        h1 className: 'mp-history-game__metadata mp-history-game__metadata--title',
          title
        h2 className: 'mp-history-game__metadata mp-history-game__metadata--artist', getArtist(@props.beatmapset)

      div className: 'mp-history-game__mods',
        el(Mod, key: mod, mod: mod) for mod in @props.game.mods

      div
        className: 'mp-history-game__team-type'
        title: osu.trans "matches.match.team-types.#{@props.game.team_type}"
        style:
          backgroundImage: "url(/images/badges/team-types/#{@props.game.team_type}.svg)"
