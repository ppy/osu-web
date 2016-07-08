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

class MPHistory.Content extends React.Component
  teamScores: (eventIndex) ->
    @scoresCache ?= {}

    if !@scoresCache[eventIndex]?
      scores =
        blue: 0
        red: 0

      for score in @props.events[eventIndex].game.data.scores.data
        continue if !score.pass
        scores[score.team] += score.score

      @scoresCache[eventIndex] = scores

    return @scoresCache[eventIndex]

  render: ->
    if _.isEmpty @props.events
      div className: 'osu-layout__row osu-layout__row--page-mp-history',
        Lang.get 'multiplayer.match.loading-events'
    else
      gameIds = _(@props.events)
        .map (m, i) ->
          return if !m.game?
          i
        .filter (m) -> m?
        .value()

        gameIds = [-1, gameIds...]

        # grabbing events that are past the last game
        lastEvents = @props.events[_.last(gameIds) + 1..@props.events.length]

      div className: 'osu-layout__row osu-layout__row--page-mp-history js-mp-history--event-box',
        if !@props.full && @props.allEventsCount > 500
          div className: 'mp-history-content__show-more-box',
            a
              className: 'mp-history-content__show-more'
              href: laroute.route 'multiplayer.match', matches: @props.id, full: true
              Lang.get 'multiplayer.match.more-events'

        for id, i in gameIds
          continue if id == -1

          prevId = gameIds[i - 1]

          div key: id,
            if (id - prevId > 1)
              events = @props.events[prevId + 1..id - 1]

              if !_.isEmpty events
                el MPHistory.EventsList, events: events, lookupUser: @props.lookupUser

            el MPHistory.Game,
              event: @props.events[id]
              teamScores: @teamScores id
              lookupUser: @props.lookupUser

        if !_.isEmpty lastEvents
          el MPHistory.EventsList, events: lastEvents, lookupUser: @props.lookupUser
