###
# Copyright 2016 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
{div, span, a} = React.DOM
el = React.createElement

class MPHistory.Score extends React.Component
  firstRow: ['combo', 'accuracy', 'score']
  secondRow: ['countgeki', 'count300', 'countkatu', 'count100', 'count50', 'countmiss']

  render: ->
    div className: 'mp-history-game__player-score mp-history-player-score',
      div
        className: 'mp-history-player-score__shapes'
        style:
          backgroundImage: "url(/images/layout/mp-history/shapes-team-#{@props.score.team}.svg)"

      div className: 'mp-history-player-score__slot',
        span className: 'mp-history-player-score__slot-number', @props.score.slot + 1

      div className: 'mp-history-player-score__main',
        div className: 'mp-history-player-score__info-box mp-history-player-score__info-box--user',
          div className: 'mp-history-player-score__username-box',
            a
              className: 'mp-history-player-score__username',
              href: laroute.route 'users.show', users: @props.score.user_id
              @props.score.user.data.username

            if !@props.score.pass
              span className: 'mp-history-player-score__failed', Lang.get 'multiplayer.match.failed'

          el FlagCountry, country: @props.countries[@props.score.user.data.country]

        div className: 'mp-history-player-score__info-box mp-history-player-score__info-box--mods hidden-xs',
          el Mods, mods: @props.score.mods

        div className: 'mp-history-player-score__info-box mp-history-player-score__info-box--stats',
          div className: 'mp-history-player-score__stat-row',
            @firstRow.map (m) =>
              modifier = 'medium'

              value = switch m
                when 'combo'
                  @props.score.combo.toLocaleString()
                when 'accuracy'
                  "#{_.round @props.score.accuracy * 100, 2}%"
                when 'score'
                  modifier = 'large'
                  @props.score.score.toLocaleString()

              div className: "mp-history-player-score__stat mp-history-player-score__stat--#{m}", key: m,
                span className: 'mp-history-player-score__stat-label mp-history-player-score__stat-label--small', Lang.get "multiplayer.match.score.stats.#{m}"
                span className: "mp-history-player-score__stat-number mp-history-player-score__stat-number--#{modifier}", value

          div className: 'mp-history-player-score__stat-row',
            @secondRow.map (m) =>
              if @props.mode != 'mania' and (m == 'countgeki' || m == 'countkatu')
                return

              div className: 'mp-history-player-score__stat mp-history-player-score__stat--small', key: m,
                span className: 'mp-history-player-score__stat-label mp-history-player-score__stat-label--large', Lang.get "multiplayer.match.score.stats.#{m}"
                span className: 'mp-history-player-score__stat-number mp-history-player-score__stat-number--small', @props.score[m].toLocaleString()
