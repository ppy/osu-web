###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
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
