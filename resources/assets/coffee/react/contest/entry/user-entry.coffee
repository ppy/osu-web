###*
*    Copyright 2015 ppy Pty. Ltd.
*
*    This file is part of osu!web. osu!web is distributed with the hope of
*    attracting more community contributions to the core ecosystem of osu!.
*
*    osu!web is free software: you can redistribute it and/or modify
*    it under the terms of the Affero GNU General Public License version 3
*    as published by the Free Software Foundation.
*
*    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
*    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*    See the GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
*
###
{div, a, i} = React.DOM
el = React.createElement

class Contest.Entry.UserEntry extends React.Component
  constructor: (props) ->
    super props

    @state =
      entry: @props.entry

  nuke: (e) =>
    e.preventDefault()

    params =
      method: 'DELETE'
      dataType: 'json'
      data:
        entry_id: @props.entry.id

    $.ajax laroute.route('contest.delete', contest_id: @props.contest_id), params

    .done (data) =>
      $.publish 'contest:entries:update', data: data

    .fail osu.ajaxError

  render: ->
    div className: 'contest__user-entry contest__user-entry--ok',
      a className: 'btn-osu btn-osu--textlike btn-osu--stick-right', href: '#', 'data-confirm': osu.trans('common.confirmation'), title: osu.trans('common.buttons.delete'), onClick: @nuke,
        i className: 'fa fa-times'
      div className: 'contest__user-entry-filename', @props.entry.filename
      div className: 'contest__user-entry-date', dangerouslySetInnerHTML: {__html: osu.timeago(@props.entry.created_at)}
      div className: 'contest__user-entry-filesize', osu.formatBytes(@props.entry.filesize)
