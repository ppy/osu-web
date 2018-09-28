###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

{br, tr, td, button, a, img, dl, dt, dd, i} = ReactDOMFactories
el = React.createElement

class @Admin.Contest.UserEntryDeleteButton extends React.Component
  update: (id, destroy) =>
    params =
      dataType: 'json'

    if destroy
      params.method = 'DELETE'
      destroyOrRestore = 'destroy'
    else
      params.method = 'POST'
      destroyOrRestore = 'restore'

    $.ajax laroute.route("admin.user-contest-entries.#{destroyOrRestore}", user_contest_entry: @props.entry.id), params
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

    a
      href: '#'
      'data-confirm': 'Are you sure?'
      onClick: onClick
      className: "btn btn-#{btnClass}",
      i className: "fa-fw #{icon}"
      label
