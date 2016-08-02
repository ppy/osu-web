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

class MPHistory.Event extends React.Component
  icons:
    'player-left': ['arrow-left', 'circle-o']
    'player-joined': ['arrow-right', 'circle-o']
    'player-kicked': ['arrow-left', 'ban']
    'match-created': ['plus']
    'match-disbanded': ['times']
    'host-changed': ['exchange']

  render: ->
    console.log @props.event.user_id

    user = @props.lookupUser @props.event.user_id

    event_type = @props.event.event_type
    event_type += '-no-user' if !user?

    className = 'mp-history-events__event mp-history-event'

    div className: className,
      div className: 'mp-history-event__time-box',
        span className: 'mp-history-event__time',
          moment(@props.event.timestamp).format 'HH:mm:ss'
      div className: "mp-history-event__type mp-history-event__type--#{@props.event.event_type}",
        @icons[@props.event.event_type].map (m) ->
          el Icon, name: m, key: m
      div className: 'mp-history-event__info-box',
        if @props.event.event_type != 'match-disbanded'
          if user?
            a
              className: 'mp-history-event__text mp-history-event__text--username'
              href: laroute.route 'users.show', users: user.id
              user.username

        span className: 'mp-history-event__text',
          Lang.get "multiplayer.match.events.#{event_type}"
