# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div, span } from 'react-dom-factories'

export class Incident extends React.Component

  render: =>
    fromNow = moment(@props.date, 'DD-MM-YYYY HH:mm:ss').fromNow()

    div className: 'status-incident',
      div className: "status-incident__state status-incident__state--#{@props.status}"
      div className: 'status-incident__content',
        div className: 'status-incident__info',
          span className: 'status-incident__info-date',
            "#{fromNow}, "
          span className: 'status-incident__info-by',
            if _.isEmpty(@props.by) then osu.trans('status_page.incidents.automated') else "by #{@props.by}"
        div className: 'status-incident__desc',
          span className: ('status-incident__desc--resolved' unless !@props.active),
            @props.description
          span null,
            " #{osu.trans('status_page.recent.incidents.state.' + @props.status)}!"
