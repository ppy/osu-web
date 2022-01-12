# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute'
import * as React from 'react'
import { br, tr, td, button, a, img, dl, dt, dd, i } from 'react-dom-factories'
el = React.createElement

export class UserEntryDeleteButton extends React.Component
  update: (id, destroy) =>
    params =
      dataType: 'json'

    if destroy
      params.method = 'DELETE'
      destroyOrRestore = 'destroy'
    else
      params.method = 'POST'
      destroyOrRestore = 'restore'

    $.ajax route("admin.user-contest-entries.#{destroyOrRestore}", user_contest_entry: @props.entry.id), params
      .done (data) =>
        $.publish "admin:contest:entries:#{destroyOrRestore}", entry: @props.entry.id
      .fail osu.ajaxError

  delete: (e) =>
    e.preventDefault()
    @update(@props.entry.id, true)

  restore: (e) =>
    e.preventDefault()
    @update(@props.entry.id, false)

  render: =>
    if @props.entry.deleted
      btnClass = 'info'
      icon = 'fas fa-magic'
      label = 'Restore'
      onClick = @restore
    else
      btnClass = 'danger'
      icon = 'far fa-trash-alt'
      label = 'Delete'
      onClick = @delete

    button
      onClick: onClick
      title: label
      className: "btn-osu-big",
      i className: "fa-fw #{icon}"
