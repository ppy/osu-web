# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { contentText } from 'modding-helpers'
import * as React from 'react'
import { a, div, li, span, ul, time } from 'react-dom-factories'
el = React.createElement

export class Event extends React.PureComponent
  constructor: (props) ->
    super props


  render: =>
    eventTime = @props.time ? moment(@props.event.created_at)

    div className: 'beatmapset-event',
      div className: "beatmapset-event__icon beatmapset-event__icon--#{_.kebabCase @props.event.type}"
      time
        className: 'beatmapset-event__time js-tooltip-time'
        dateTime: @props.event.created_at
        title: @props.event.created_at
        eventTime.format 'LT'
      div
        className: 'beatmapset-event__content'
        dangerouslySetInnerHTML:
          __html: contentText(@props.event, @props.users, @props.event.comment?.beatmap_discussion_id, @props.discussions)
