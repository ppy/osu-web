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

{div} = ReactDOMFactories
el = React.createElement

class MPHistory.Main extends React.Component
  FETCH_LIMIT = 100
  MAXIMUM_EVENTS = 500
  REFRESH_TIMEOUT = 10000

  findLastGame = (events) ->
    _.findLast events, (e) -> e.game?


  constructor: (props) ->
    super props

    events = props.events.events

    @timeouts = {}

    @state =
      events: events
      users: _.keyBy props.events.users, 'id'
      currentGameId: props.events.current_game_id
      latestEventId: props.events.latest_event_id
      loadingPrevious: false


  componentDidMount: =>
    @timeouts.autoload = Timeout.set REFRESH_TIMEOUT, @autoload


  render: =>
    div className: 'osu-layout__section',
      el MPHistory.Header,
        name: @props.match.name

      el MPHistory.Content,
        id: @props.match.id
        events: @state.events
        currentGameId: @state.currentGameId
        allEventsCount: @state.allEventsCount
        users: @state.users
        hasNext: @hasNext()
        hasPrevious: @hasPrevious()
        loadingNext: @state.loadingNext
        loadingPrevious: @state.loadingPrevious
        loadNext: @loadNext
        loadPrevious: @loadPrevious
        isAutoloading: @isAutoloading()


  componentWillUnmount: ->
    Timeout.clear timeout for _name, timeout of @timeouts


  isAutoloading: =>
    @state.latestEventId == _.last(@state.events)?.id


  autoload: =>
    return if !@isAutoloading()

    @loadNext()


  delayedAutoload: =>
    @timeouts.autoload = Timeout.set REFRESH_TIMEOUT, @autoload


  hasNext: =>
    _.last(@state.events)?.detail.type != 'match-disbanded'


  loadNext: =>
    return if !@hasNext()

    Timeout.clear @timeouts.autoload
    @setState loadingNext: true

    $.ajax laroute.route('matches.history', match: @props.match.id),
      method: 'GET'
      dataType: 'JSON'
      data:
        after: @minNextEventId()
        limit: FETCH_LIMIT

    .done (data) =>
      return if _.isEmpty data.events

      startEventId = data.events[0]?.id ? 0

      newEvents = _.dropRightWhile @state.events, (e) -> e.id >= startEventId
        .concat(data.events)[-MAXIMUM_EVENTS..]
      newUsers = @newUsersHash data.users

      @setState
        events: newEvents
        users: newUsers
        currentGameId: data.current_game_id
        latestEventId: data.latest_event_id

    .always =>
      @setState loadingNext: false
      @delayedAutoload()


  minNextEventId: =>
    if @state.currentGameId?
      currentGame = _.find(@state.events, game_id: @state.currentGameId)

      id = currentGame.id - 1 if currentGame?

    id ? _.last(@state.events)?.id


  hasPrevious: =>
    @state.events[0].detail.type != 'match-created'


  loadPrevious: =>
    return if !@hasPrevious()

    @setState loadingPrevious: true

    $.ajax laroute.route('matches.history', match: @props.match.id),
      method: 'GET'
      dataType: 'JSON'
      data:
        before: @state.events[0]?.id
        limit: FETCH_LIMIT

    .done (data) =>
      return if _.isEmpty data.events

      newEvents = data.events.concat(@state.events)[..MAXIMUM_EVENTS]
      newUsers = @newUsersHash data.users

      @setState
        events: newEvents
        users: newUsers
        currentGameId: data.current_game_id
        latestEventId: data.latest_event_id

    .always =>
      @setState loadingPrevious: false


  newUsersHash: (users) =>
    _({})
      .assign @state.users
      .assign _.keyBy(users, 'id')
      .value()
