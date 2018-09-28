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

{br, tr, td, a, img, dl, dt, dd, div} = ReactDOMFactories
el = React.createElement

class @Admin.Contest.UserArtEntry extends React.Component
  render: =>
    className = 'admin-contest-entry'
    className += ' admin-contest-entry__deleted' if @props.entry.deleted

    tr
      className: className
      key: @props.entry.id,

      td className: 'admin-contest-entry__user-column',
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

        el Admin.Contest.UserEntryDeleteButton,
          entry: @props.entry

      td {},
        a download: @props.entry.original_filename, href: @props.entry.url,
          img className: 'img-responsive admin-contest-entry__thumbnail', src: @props.entry.url
