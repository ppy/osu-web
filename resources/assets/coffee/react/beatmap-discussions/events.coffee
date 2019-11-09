###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import { Event } from './event'
import * as React from 'react'
import { a, div, li, span, ul } from 'react-dom-factories'
el = React.createElement

export class Events extends React.PureComponent
  constructor: (props) ->
    super props


  render: =>
    lastCreatedAtString = null

    div className: 'osu-page osu-page--small osu-page--generic',
      div className: 'beatmapset-events',
        if _.isEmpty @props.events
          div
            className: 'beatmapset-events__empty'
            osu.trans('beatmap_discussions.events.empty')
        else
          for event in @props.events by -1
            createdAt = moment(event.created_at)
            createdAtString = createdAt.format 'LL'

            [
              if lastCreatedAtString != createdAtString
                lastCreatedAtString = createdAtString
                div
                  key: "date-#{lastCreatedAtString}"
                  className: 'beatmapset-events__title'
                  lastCreatedAtString
              div
                key: event.id
                className: 'beatmapset-events__event'
                el Event,
                  event: event
                  time: createdAt
                  users: @props.users
                  discussions: @props.discussions
            ]
