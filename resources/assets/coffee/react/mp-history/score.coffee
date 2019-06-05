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

import { FlagCountry } from 'flag-country'
import { Mods } from 'mods'
import * as React from 'react'
import { div, span, a } from 'react-dom-factories'
el = React.createElement

export class Score extends React.Component
  firstRow: ['combo', 'accuracy', 'score']
  secondRow: ['count_geki', 'count_300', 'count_katu', 'count_100', 'count_50', 'count_miss']

  render: ->
    user = @props.users[@props.score.user_id]

    div className: 'mp-history-game__player-score mp-history-player-score',
      div
        className: 'mp-history-player-score__shapes'
        style:
          backgroundImage: "url(/images/layout/mp-history/shapes-team-#{@props.score.multiplayer.team}.svg)"

      div className: 'mp-history-player-score__main',
        div className: 'mp-history-player-score__info-box mp-history-player-score__info-box--user',
          div className: 'mp-history-player-score__username-box',
            a
              className: 'mp-history-player-score__username',
              href: laroute.route 'users.show', user: user.id
              user.username

            if !@props.score.multiplayer.pass
              span className: 'mp-history-player-score__failed', osu.trans 'multiplayer.match.failed'

          a
            href: laroute.route 'rankings',
              mode: @props.mode
              country: user.country?.code
              type: 'performance'
            el FlagCountry, country: user.country

        div className: 'mp-history-player-score__info-box mp-history-player-score__info-box--stats',
          div className: 'mp-history-player-score__stat-row mp-history-player-score__stat-row--first',
            div className: 'mp-history-player-score__mods-box',
              el Mods,
                mods: @props.score.mods
                modifiers: ['reversed']

            @firstRow.map (m) =>
              modifier = 'medium'

              value = switch m
                when 'combo'
                  osu.formatNumber(@props.score.max_combo)
                when 'accuracy'
                  "#{_.round @props.score.accuracy * 100, 2}%"
                when 'score'
                  modifier = 'large'
                  osu.formatNumber(@props.score.score)

              div className: "mp-history-player-score__stat mp-history-player-score__stat--#{m}", key: m,
                span className: 'mp-history-player-score__stat-label mp-history-player-score__stat-label--small', osu.trans "multiplayer.match.score.stats.#{m}"
                span className: "mp-history-player-score__stat-number mp-history-player-score__stat-number--#{modifier}", value

          div className: 'mp-history-player-score__stat-row',
            @secondRow.map (m) =>
              if @props.mode != 'mania' and (m == 'count_geki' || m == 'count_katu')
                return

              div
                className: 'mp-history-player-score__stat mp-history-player-score__stat--small'
                key: m,
                span
                  className: 'mp-history-player-score__stat-label mp-history-player-score__stat-label--large'
                  osu.trans "common.score_count.#{m}"
                span
                  className: 'mp-history-player-score__stat-number mp-history-player-score__stat-number--small'
                  osu.formatNumber(@props.score.statistics[m])
