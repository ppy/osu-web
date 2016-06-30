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
{div} = React.DOM
el = React.createElement

class MPHistory.Main extends React.Component
  timeBetweenRefresh: 10000
  eventsIncrement: 100

  constructor: (props) ->
    super props

    @state =
      endTime: props.end_time
      name: name
      events: []
      since: 0
      teamType: ''
      eventsShown: 100
      disbanded: false

    @loadHistory @state.since

  loadHistory: =>
    $.ajax laroute.route('multiplayer.match.history', matches: @props.match.id),
      method: 'GET'
      dataType: 'JSON'
      data:
        since: @state.since

    .done (data) =>
      return if _.isEmpty data.data

      newEvents = _.concat @state.events, data.data

      lastEvent = _.last(newEvents)

      eventsShown = @state.eventsShown
      eventsShown += data.data.length if !_.isEmpty @state.events

      @setState
        events: newEvents
        since: _.last(newEvents).id
        teamType: @getTeamType _.findLast(newEvents, (o) -> o.game?).game.data.team_type
        eventsShown: eventsShown
        disbanded: lastEvent.text == 'DISBAND'

    .always =>
      if !@state.disbanded
        setTimeout @loadHistory, 10000

  _showMore: =>
    @setState (state, props) =>
      eventsShown: state.eventsShown + Math.min @eventsIncrement, @state.events.length - state.eventsShown

  componentDidMount: ->
    $.subscribe 'events:show-more.mpHistoryPage', @_showMore

  componentWillUnmount: ->
    $.unsubscribe '.mpHistoryPage'

  render: ->
    remainingEventsCount = @state.events.length - @state.eventsShown

    div className: 'osu-layout__section',
      el MPHistory.Header,
        name: @props.match.name
        teamType: @state.teamType

      el MPHistory.Content,
        events: @state.events[remainingEventsCount..]
        remainingEventsCount: remainingEventsCount
        countries: @props.countries

  getTeamType: (typeInt) ->
    types =
      0: 'head-to-head'
      1: 'tag-coop'
      2: 'team-vs'
      3: 'tag-team-vs'

    types[typeInt]
