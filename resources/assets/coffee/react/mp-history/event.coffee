###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

import * as React from 'react'
import { div, span, a, i } from 'react-dom-factories'
import TimeWithTooltip from 'time-with-tooltip'

el = React.createElement

export class Event extends React.Component
  icons:
    'player-left': ['fas fa-arrow-left', 'far fa-circle']
    'player-joined': ['fas fa-arrow-right', 'far fa-circle']
    'player-kicked': ['fas fa-arrow-left', 'fas fa-ban']
    'match-created': ['fas fa-plus']
    'match-disbanded': ['fas fa-times']
    'host-changed': ['fas fa-exchange-alt']

  render: ->
    user = @props.users[@props.event.user_id]

    event_type = @props.event.detail.type

    if user? && event_type != 'match-disbanded'
      userLink = osu.link laroute.route('users.show', user: user.id),
        user.username
        classNames: ['mp-history-event__username']

    div className: 'mp-history-event',
      div className: 'mp-history-event__time',
        el TimeWithTooltip, dateTime: @props.event.timestamp, format: 'LTS'
      div className: "mp-history-event__type mp-history-event__type--#{event_type}",
        @icons[event_type].map (m) ->
          i key: m, className: m
      div
        className: 'mp-history-event__text',
        dangerouslySetInnerHTML:
          __html: osu.trans "multiplayer.match.events.#{event_type}#{if user? then '' else '-no-user'}",
            user: userLink
