# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import Event from 'beatmap-discussions/event'
import * as React from 'react'
import { a, div, li, span, ul } from 'react-dom-factories'
el = React.createElement

export class Events extends React.PureComponent
  constructor: (props) ->
    super props


  render: =>
    lastCreatedAtString = null
    events = @props.events.filter (event) -> event.type != 'nomination_reset_received'

    div className: 'osu-page osu-page--small osu-page--generic',
      div className: 'beatmapset-events',
        if _.isEmpty events
          div
            className: 'beatmapset-events__empty'
            osu.trans('beatmap_discussions.events.empty')
        else
          for event in events by -1
            createdAtString = moment(event.created_at).format 'LL'

            [
              if lastCreatedAtString != createdAtString
                lastCreatedAtString = createdAtString
                div
                  key: "date-#{lastCreatedAtString}"
                  className: 'beatmapset-events__title'
                  lastCreatedAtString
              el Event,
                key: event.id
                event: event
                discussions: @props.discussions
                mode: 'discussions'
                time: event.created_at
                users: @props.users
            ]
