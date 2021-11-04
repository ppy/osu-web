# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div, span, a, i } from 'react-dom-factories'
import TimeWithTooltip from 'time-with-tooltip'
import { link } from 'utils/url'

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
      userLink = link laroute.route('users.show', user: user.id),
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
          __html: osu.trans "matches.match.events.#{event_type}#{if user? then '' else '-no-user'}",
            user: userLink
