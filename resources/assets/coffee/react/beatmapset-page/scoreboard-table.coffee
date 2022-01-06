# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { ScoreboardTableRow } from './scoreboard-table-row'
import * as React from 'react'
import { a, div, table, tr, th, thead, tbody } from 'react-dom-factories'
import { activeKeyDidChange, ContainerContext, KeyContext } from 'stateful-activation-context'
import { shouldShowPp } from 'utils/beatmap-helper'
import { classWithModifiers } from 'utils/css'
import { modeAttributesMap } from 'utils/score-helper'

el = React.createElement
bn = 'beatmap-scoreboard-table'

export class ScoreboardTable extends React.PureComponent
  constructor: (props) ->
    super props

    @activeKeyDidChange = activeKeyDidChange.bind(@)

    @state = {}


  render: =>
    classMods = ['menu-active'] if @state.activeKey?
    showPp = shouldShowPp(@props.beatmap)

    el ContainerContext.Provider,
      value:
        activeKeyDidChange: @activeKeyDidChange

      div className: classWithModifiers(bn, classMods),
        table
          className: "#{bn}__table"
          thead {},
            tr {},
              th className: "#{bn}__header #{bn}__header--rank", osu.trans('beatmapsets.show.scoreboard.headers.rank')
              th className: "#{bn}__header #{bn}__header--grade", ''
              th className: "#{bn}__header #{bn}__header--score", osu.trans('beatmapsets.show.scoreboard.headers.score')
              th className: "#{bn}__header #{bn}__header--accuracy", osu.trans('beatmapsets.show.scoreboard.headers.accuracy')
              th className: "#{bn}__header #{bn}__header--flag", ''
              th className: "#{bn}__header #{bn}__header--player", osu.trans('beatmapsets.show.scoreboard.headers.player')
              th className: "#{bn}__header #{bn}__header--maxcombo", osu.trans('beatmapsets.show.scoreboard.headers.combo')
              for stat in modeAttributesMap[@props.beatmap.mode]
                th key: stat.attribute, className: "#{bn}__header #{bn}__header--hitstat", stat.label
              th className: "#{bn}__header #{bn}__header--miss", osu.trans('beatmapsets.show.scoreboard.headers.miss')
              if showPp
                th className: "#{bn}__header #{bn}__header--pp", osu.trans('beatmapsets.show.scoreboard.headers.pp')
              th className: "#{bn}__header #{bn}__header--time", osu.trans('beatmapsets.show.scoreboard.headers.time')
              th className: "#{bn}__header #{bn}__header--mods", osu.trans('beatmapsets.show.scoreboard.headers.mods')
              th className: "#{bn}__header #{bn}__header--popup-menu"

          tbody className: "#{bn}__body",
            @props.scores.map (score, index) =>
              el KeyContext.Provider,
                key: index
                value: index
                el ScoreboardTableRow,
                  activated: @state.activeKey == index
                  beatmap: @props.beatmap
                  showPp: showPp
                  index: index
                  score: score
                  scoreboardType: @props.scoreboardType
