# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute'
import * as React from 'react'
import { tr, td, a, div } from 'react-dom-factories'
import UserAvatar from 'user-avatar'
import { UserEntryDeleteButton } from './user-entry-delete-button'

el = React.createElement

export class UserEntry extends React.Component
  render: =>
    className = 'osu-table__body-row osu-table__body-row--highlightable admin-contest-entry'
    className += ' admin-contest-entry__deleted' if @props.entry.deleted

    tr
      className: className
      key: @props.entry.id,

      td className: 'osu-table__cell admin-contest-entry__column',
        a
          className: 'admin-contest-entry__user-link'
          href: route('users.show', user: @props.entry.user.id),
          div className: 'admin-contest-entry__avatar',
            el UserAvatar, user: @props.entry.user, modifiers: ['full-rounded']
          @props.entry.user.username

      td className: 'osu-table__cell admin-contest-entry__column',
          a download: @props.entry.original_filename, href: @props.entry.url, @props.entry.filename

      td className: 'osu-table__cell admin-contest-entry__column',
          osu.formatBytes(@props.entry.filesize)

      td className: 'admin-contest-entry__column admin-contest-entry__column--button',
        el UserEntryDeleteButton,
          entry: @props.entry
