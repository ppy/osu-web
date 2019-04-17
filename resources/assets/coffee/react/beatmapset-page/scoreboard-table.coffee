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

import { ScoreboardTableRow } from './scoreboard-table-row'
import * as React from 'react'
import { a, div, table, tr, th, thead, tbody } from 'react-dom-factories'
import { activeKeyDidChange, ContainerContext, KeyContext } from 'stateful-activation-context'
el = React.createElement
bn = 'beatmap-scoreboard-table'

export class ScoreboardTable extends React.PureComponent
  constructor: (props) ->
    super props

    @activeKeyDidChange = activeKeyDidChange.bind(@)

    @state = {}


  render: =>
    classMods = ['menu-active'] if @state.activeKey?

    el ContainerContext.Provider,
      value:
        activeKeyDidChange: @activeKeyDidChange

      div className: osu.classWithModifiers(bn, classMods),
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
              for stat in @props.hitTypeMapping
                th key: stat[0], className: "#{bn}__header #{bn}__header--hitstat", stat[0]
              th className: "#{bn}__header #{bn}__header--miss", osu.trans('beatmapsets.show.scoreboard.headers.miss')
              th className: "#{bn}__header #{bn}__header--pp", osu.trans('beatmapsets.show.scoreboard.headers.pp')
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
                  countries: @props.countries
                  hitTypeMapping: @props.hitTypeMapping
                  index: index
                  score: score
                  scoreboardType: @props.scoreboardType
