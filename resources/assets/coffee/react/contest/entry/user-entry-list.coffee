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
{div} = React.DOM
el = React.createElement

class Contest.Entry.UserEntryList extends React.Component
  constructor: (props) ->
    super props

    @state =
      contest: @props.contest
      userEntries: @props.userEntries

  handleUpdate: (_e, {data}) =>
    @setState
      userEntries: data

  componentDidMount: ->
    $.subscribe 'contest:entries:update.contest', @handleUpdate

  componentWillUnmount: ->
    $.unsubscribe '.contest'

  render: ->
    userEntries = if @state.userEntries then @state.userEntries else []
    entries = userEntries.map (entry, index) =>
      el Contest.Entry.UserEntry,
        key: index,
        entry: entry,
        contest_id: @state.contest.id

    div className: 'contest-user-entry-list',
      entries
      el Contest.Entry.Uploader, contest: @state.contest, disabled: @state.userEntries.length >= @state.contest.max_entries
