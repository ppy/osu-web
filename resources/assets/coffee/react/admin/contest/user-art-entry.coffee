###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

import { UserEntryDeleteButton } from './user-entry-delete-button'
import * as React from 'react'
import { br, tr, td, a, img, dl, dt, dd, div } from 'react-dom-factories'
import { UserAvatar } from 'user-avatar'
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
          href: laroute.route('users.show', user: @props.entry.user.id)
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
