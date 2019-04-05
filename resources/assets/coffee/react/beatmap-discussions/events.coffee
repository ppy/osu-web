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
