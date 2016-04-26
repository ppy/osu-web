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
{div, span} = React.DOM
el = React.createElement

class BeatmapSetPage.ScoreboardFirst extends React.Component
  stats = ['score', 'accuracy', '300', '100', '50']

  render: ->
    div className: 'beatmapset-scoreboard-first',
      div className: 'beatmapset-scoreboard-first__item beatmapset-scoreboard-first__item--left',
        div className: 'beatmapset-scoreboard-first__meta',
          span className: 'beatmapset-scoreboard-first__label beatmapset-scoreboard-first__label--rank', "#1"
          span className: 'beatmapset-scoreboard-first__label beatmapset-scoreboard-first__label--username',
            @props.score.user.data.username
          if @props.score.user.data.country
            el FlagCountry,
              country:
                code: @props.score.user.data.country
                name: @props.countries[@props.score.user.data.country].name
              classModifiers: ['scoreboard']
        div className: 'beatmapset-scoreboard-first__avatar-container',
          div
            className: 'beatmapset-scoreboard-first__avatar avatar avatar--beatmapset-scoreboard',
            style:
              backgroundImage: "url(#{@props.score.user.data.avatarUrl})"
      div className: 'beatmapset-scoreboard-first__item beatmapset-scoreboard-first__item--right',
        stats.map (m) =>
          dt = Lang.get "beatmaps.beatmapset.show.extra.scoreboard.first.#{m}"
          switch m
            when 'score'
              dd = @props.score.score.toLocaleString()
            when 'accuracy'
              dd = "#{_.round @props.score.accuracy * 100, 2}%"
            when '300'
              dd = @props.score.count300
            when '100'
              dd = @props.score.count100
            when '50'
              dd = @props.score.count50

          el 'dl', className: 'beatmapset-scoreboard-first__stat-row', key: m,
            el 'dt', className: 'beatmapset-scoreboard-first__stat', dt
            el 'dd', className: 'beatmapset-scoreboard-first__stat beatmapset-scoreboard-first__stat--value', dd
