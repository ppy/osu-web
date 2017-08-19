###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

{div, a} = ReactDOMFactories
el = React.createElement

class MPHistory.Content extends React.Component
  teamScores: (eventIndex) ->
    return if !@props.events[eventIndex].game?

    @scoresCache ?= {}

    if !@scoresCache[eventIndex]?
      scores =
        blue: 0
        red: 0

      return scores if !@props.events[eventIndex].game.end_time?

      for score in @props.events[eventIndex].game.scores
        continue if !score.multiplayer.pass
        scores[score.multiplayer.team] += score.score

      @scoresCache[eventIndex] = scores

    return @scoresCache[eventIndex]

  render: ->
    if _.isEmpty @props.events
      div className: 'osu-layout__row osu-layout__row--page-mp-history',
        osu.trans 'multiplayer.match.loading-events'
    else
      div className: 'osu-layout__row osu-layout__row--page-mp-history js-mp-history--event-box',
        if !@props.full && @props.allEventsCount > 500
          div className: 'mp-history-content__show-more-box',
            a
              className: 'mp-history-content__show-more'
              href: laroute.route('matches.show', match: @props.id, full: true)
              osu.trans 'multiplayer.match.more-events'

        div className: 'mp-history-events',
          for event, i in @props.events
            if event.detail.type == 'other'
              continue if !event.game? || (!event.game.end_time? && event.id != @props.lastGameId)

              div
                className: 'mp-history-events__game'
                key: event.id
                el MPHistory.Game,
                  event: event
                  teamScores: @teamScores i
                  lookupUser: @props.lookupUser
            else
              div
                className: 'mp-history-events__event'
                key: event.id
                el MPHistory.Event,
                  event: event
                  lookupUser: @props.lookupUser
                  key: event.id
