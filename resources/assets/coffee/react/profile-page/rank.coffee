###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
el = React.createElement

class ProfilePage.Rank extends React.Component
  render: =>
    return el('div') unless @props.rank.isRanked

    el 'div', className: 'user-profile-header__basic user-profile-header__basic--right',
        el 'p',
          className: 'profile-basic profile-basic--large'
          title: Lang.get('users.show.rank.global', mode: Lang.get("beatmaps.mode.#{@props.currentMode}"))
          el 'span', className: 'user-rank-icon',
            el 'i', className: "fa osu fa-#{@props.currentMode}-o"
          "##{@props.rank.global.toLocaleString()}"
        if @props.countryName != null
          el 'p',
            className: 'profile-basic'
            title: Lang.get('users.show.rank.country', mode: Lang.get("beatmaps.mode.#{@props.currentMode}"))
            "#{@props.countryName} ##{@props.rank.country.toLocaleString()}"
