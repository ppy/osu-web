# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import UserAvatar from 'components/user-avatar'
import { route } from 'laroute'
import * as React from 'react'
import { br, tr, td, a, img, dl, dt, dd, div } from 'react-dom-factories'
import { UserEntryDeleteButton } from './user-entry-delete-button'

el = React.createElement

export class UserArtEntry extends React.Component
  render: =>
    className = 'osu-table__body-row osu-table__body-row--highlightable admin-contest-entry'
    className += ' admin-contest-entry__deleted' if @props.entry.deleted

    tr
      className: className
      key: @props.entry.id,

      td className: 'osu-table__cell admin-contest-entry__user-column',
        a
          href: route('users.show', user: @props.entry.user.id)
          el UserAvatar, user: @props.entry.user, modifiers: ['profile']
          div className: 'admin-contest-entry__username',
            @props.entry.user.username

        dl {},
          dt className: 'admin-contest__meta-row', 'Filename'
          dd className: 'admin-contest__meta-row',
            a download: @props.entry.original_filename, href: @props.entry.url, @props.entry.filename
          dt className: 'admin-contest__meta-row', 'Filesize'
          dd className: 'admin-contest__meta-row', osu.formatBytes(@props.entry.filesize)

      td className: 'osu-table__cell admin-contest-entry__preview',
        a download: @props.entry.original_filename, href: @props.entry.url,
          img className: 'img-responsive admin-contest-entry__thumbnail', src: @props.entry.thumb

      td className: 'admin-contest-entry__column admin-contest-entry__column--button',
        el UserEntryDeleteButton,
          entry: @props.entry
