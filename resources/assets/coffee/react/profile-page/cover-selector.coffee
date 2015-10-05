###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
el = React.createElement

class ProfilePage.CoverSelector extends React.Component
  render: =>
    el 'div', className: 'profile-change-cover-popup',
      el 'div', className: 'profile-change-cover-defaults',
        for i in [1..8]
          i = i.toString()
          el ProfilePage.CoverSelection,
            key: i
            name: i
            isSelected: @props.cover.id == i
            url: "/images/headers/profile-covers/c#{i}.jpg"
            thumbUrl: "/images/headers/profile-covers/c#{i}t.jpg"
        el 'p', className: 'profile-cover-selections-info',
          Lang.get 'users.show.edit.cover.defaults_info'
      el ProfilePage.CoverUploader, cover: @props.cover, canUpload: @props.canUpload
