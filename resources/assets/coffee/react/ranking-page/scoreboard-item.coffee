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
{div, a} = React.DOM
el = React.createElement

bn = 'ranking-scoreboard'

class RankingPage.ScoreboardItem extends React.Component
  render: ->
    elements = ['rank', 'flag', 'player', 'accuracy', 'play-count', 'score', 'x-count', 's-count', 'a-count']
    rowClassName = "#{bn}__row #{bn}__row--score"
    if (@props.score.user.data.id == currentUser.id)
      rowClassName += " #{bn}__row--myself"

    div className: rowClassName,
      elements.map (m) =>
        className = "#{bn}__row-item #{bn}__row-item--#{m}"
        contents =
          switch m
            when 'rank'
              "##{@props.position}"
            when 'flag'
              if @props.score.user.data.country
                el FlagCountry,
                  country: @props.countries[@props.score.user.data.country]
                  classModifiers: ['scoreboard']
            when 'player'
              a
                href: (laroute.route 'users.show', users: @props.score.user.data.id) + ProfilePageHash.generate(page: 'main', mode: @props.mode) 
                @props.score.user.data.username
            when 'accuracy'
              "#{_.round @props.score.hitAccuracy, 2}%"
            when 'play-count'
              className += ' hidden-xs'
              @props.score.playCount.toLocaleString()
            when 'score'
              "#{(_.round @props.score.rank.score, 0).toLocaleString()}pp"
            when 'x-count'
              className += ' hidden-xs'
              @props.score.scoreRanks.X.toLocaleString()
            when 's-count'
              className += ' hidden-xs'
              @props.score.scoreRanks.S.toLocaleString()
            when 'a-count'
              className += ' hidden-xs'
              @props.score.scoreRanks.A.toLocaleString()

        div className: className, key: m, contents
