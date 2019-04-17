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
