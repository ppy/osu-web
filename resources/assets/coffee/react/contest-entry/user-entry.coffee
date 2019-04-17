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
import { div, a, i } from 'react-dom-factories'
el = React.createElement

export class UserEntry extends React.Component
  delete: (e) =>
    e.preventDefault()

    params =
      method: 'DELETE'
      dataType: 'json'

    $.ajax laroute.route('contest-entries.destroy', contest_entry: @props.entry.id), params

    .done (data) =>
      $.publish 'contest:entries:update', data: data

    .fail osu.ajaxError

  render: ->
    div className: 'contest-userentry contest-userentry--ok',
      if !@props.locked
        a className: 'btn-osu btn-osu--textlike btn-osu--stick-right', href: '#', 'data-confirm': osu.trans('common.confirmation'), title: osu.trans('common.buttons.delete'), onClick: @delete,
          i className: 'fas fa-times'

      div className: 'contest-userentry__fileicon',
        i className: 'far fa-file'

      div className: 'contest-userentry__filename u-ellipsis-overflow', @props.entry.filename
      div className: 'contest-userentry__entry-date', dangerouslySetInnerHTML: {__html: osu.timeago(@props.entry.created_at)}
      div className: 'contest-userentry__filesize', osu.formatBytes(@props.entry.filesize)
