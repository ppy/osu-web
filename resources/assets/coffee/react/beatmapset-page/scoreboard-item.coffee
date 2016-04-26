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

class BeatmapSetPage.ScoreboardItem extends React.Component
  items = ['rank', 'flag', 'player', 'icons', 'score', 'accuracy']

  render: ->
    div className: 'beatmapset-scoreboard__row beatmapset-scoreboard__row--score',
      items.map (m) =>
        className = "beatmapset-scoreboard__row-item beatmapset-scoreboard__row-item--#{m}"
        contents =
          switch m
            when 'rank'
              "##{@props.position}"
            when 'flag'
              if @props.score.user.data.country
                el FlagCountry,
                  country:
                    code: @props.score.user.data.country
                    name: @props.countries[@props.score.user.data.country].name
                  classModifiers: ['scoreboard']
            when 'player'
              @props.score.user.data.username
            when 'icons'
              div className: "badge-rank badge-rank--#{@props.score.rank}"
            when 'score'
              @props.score.score.toLocaleString()
            when 'accuracy'
              "#{_.round @props.score.accuracy * 100, 2}%"

        span className: className, key: m, contents
