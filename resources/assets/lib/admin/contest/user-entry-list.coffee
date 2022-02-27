# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { UserEntry } from './user-entry'
import { UserArtEntry } from './user-art-entry'
import * as React from 'react'
import { div, table, tr, a, tbody, h4, thead, th } from 'react-dom-factories'
import { nextVal } from 'utils/seq'
el = React.createElement

export class UserEntryList extends React.Component
  constructor: (props) ->
    super props

    @eventId = "admin-contests-show-user-entries-#{nextVal()}"
    @state =
      contest: props.contest
      entries: props.entries
      showDeleted: false

  updateEntry: (id, deleted) =>
    newEntries = _.clone(@state.entries)
    _.find(newEntries, {'id': id}).deleted = deleted

    @setState entries: newEntries

  delete: (_e, data) =>
    @updateEntry(data.entry, true)

  restore: (_e, data) =>
    @updateEntry(data.entry, false)

  componentDidMount: =>
    $.subscribe "admin:contest:entries:destroy.#{@eventId}", @delete
    $.subscribe "admin:contest:entries:restore.#{@eventId}", @restore

  componentWillUnmount: =>
    $.unsubscribe ".#{@eventId}"

  toggleShowDeleted: (e) =>
    e.preventDefault()

    @setState
      showDeleted: !@state.showDeleted

  render: =>
    entries =
      if @state.showDeleted
        @state.entries
      else
        _.filter @state.entries, {'deleted': false}

    deletedEntries = _.filter @state.entries, {'deleted': true}

    div {},
      div className: 'row',
        div className: 'col-md-6',
          h4 {},
            "#{@state.entries.length} Entries"
            if !_.isEmpty(deletedEntries)
              ", #{deletedEntries.length} Deleted"

        div className: 'col-md-6 text-right',
          h4 {},
            a href: '#', onClick: @toggleShowDeleted,
              "#{if @state.showDeleted then 'hide' else 'show'} deleted"

      if @props.contest.type == 'art'
        div className: 'osu-table osu-table--with-handle',
          table className: 'osu-table__table',
            thead {},
              tr {},
                th className: 'osu-table__header admin-contest__table-column--username'
                th className: 'osu-table__header'
                th className: 'osu-table__header admin-contest__table-column--button'
            tbody {}, entries.map (entry) ->
              el UserArtEntry,
                key: entry.id
                entry: entry

      else
        div className: 'osu-table osu-table--taller-rows osu-table--with-handle',
          table className: 'osu-table__table',
            thead {},
              tr {},
                th className: 'osu-table__header admin-contest__table-column--username', 'Username'
                th className: 'osu-table__header', 'Filename'
                th className: 'osu-table__header admin-contest__table-column--filesize', 'Filesize'
                th className: 'osu-table__header admin-contest__table-column--button'

            tbody {}, entries.map (entry) ->
              el UserEntry,
                key: entry.id
                entry: entry
