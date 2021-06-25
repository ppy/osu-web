# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Uploader } from './uploader'
import { UserEntry } from './user-entry'
import * as React from 'react'
import { div } from 'react-dom-factories'
el = React.createElement

export class UserEntryList extends React.Component
  constructor: (props) ->
    super props

    @eventId = "contests-show-enter-#{osu.uuid()}"
    @state =
      contest: @props.contest
      userEntries: @props.userEntries

  handleUpdate: (_e, {data}) =>
    @setState
      userEntries: data

  componentDidMount: ->
    $.subscribe "contest:entries:update.#{@eventId}", @handleUpdate

  componentWillUnmount: ->
    $.unsubscribe ".#{@eventId}"

  render: ->
    entryOpen = moment(@state.contest.entry_starts_at).diff() <= 0 && moment(@state.contest.entry_ends_at).diff() >= 0
    userEntries = if @state.userEntries then @state.userEntries else []

    entries = userEntries.map (entry, index) =>
      el UserEntry,
        key: index,
        entry: entry,
        contest_id: @state.contest.id,
        locked: !entryOpen

    return null if not entryOpen and _.isEmpty(userEntries)

    div className: 'contest-userentry-list',
      entries
      el Uploader, contest: @state.contest, disabled: !entryOpen || (@state.userEntries.length >= @state.contest.max_entries)
