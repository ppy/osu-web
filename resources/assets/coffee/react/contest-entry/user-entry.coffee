# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { button, div, i } from 'react-dom-factories'
import TimeWithTooltip from 'time-with-tooltip'
el = React.createElement

export class UserEntry extends React.Component
  delete: =>
    return unless confirm(osu.trans('common.confirmation'))

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
        button
          className: 'contest-userentry__delete'
          type: 'button'
          title: osu.trans('common.buttons.delete')
          onClick: @delete
          i className: 'fas fa-times'

      div className: 'contest-userentry__fileicon',
        i className: 'far fa-file'

      div className: 'contest-userentry__filename u-ellipsis-overflow',
        @props.entry.filename

      div className: 'contest-userentry__entry-date',
        el TimeWithTooltip, dateTime: @props.entry.created_at, relative: true

      div className: 'contest-userentry__filesize',
        osu.formatBytes(@props.entry.filesize)
