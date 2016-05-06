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

class BeatmapsetPage.ScoreboardFirst extends React.Component
  render: ->
    elements = ['score', 'accuracy', 'count300', 'count100', 'count50']

    div className: 'beatmapset-scoreboard-first',
      div className: 'beatmapset-scoreboard-first__item beatmapset-scoreboard-first__item--left',
        div className: 'beatmapset-scoreboard-first__meta',
          span className: 'beatmapset-scoreboard-first__label beatmapset-scoreboard-first__label--rank', "#1"
          span className: 'beatmapset-scoreboard-first__label beatmapset-scoreboard-first__label--username',
            a
              href: laroute.route 'users.show', users: @props.score.user.data.id
              @props.score.user.data.username
          if @props.score.user.data.country
            el FlagCountry,
              country: @props.countries[@props.score.user.data.country]
              classModifiers: ['scoreboard']
        div className: 'beatmapset-scoreboard-first__avatar-container',
          div
            className: 'beatmapset-scoreboard-first__avatar avatar avatar--beatmapset-scoreboard',
            style:
              backgroundImage: "url(#{@props.score.user.data.avatarUrl})"
      div className: 'beatmapset-scoreboard-first__item beatmapset-scoreboard-first__item--right',
        elements.map (m) =>
          dt = Lang.get "beatmaps.beatmapset.show.extra.scoreboard.first.#{m}"
          dd = @props.score[m]

          dd =
            if m == 'accuracy'
              "#{_.round @props.score.accuracy * 100, 2}%"
            else
              dd.toLocaleString()

          el 'dl', className: 'beatmapset-scoreboard-first__stat-row', key: m,
            el 'dt', className: 'beatmapset-scoreboard-first__stat', dt
            el 'dd', className: 'beatmapset-scoreboard-first__stat beatmapset-scoreboard-first__stat--value', dd
