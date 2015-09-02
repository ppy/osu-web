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

class Tab extends React.Component
  _modeSwitch: =>
    $(document).trigger 'profilePageExtra:tab', @props.mode


  render: =>
    className = 'profile-extra-tabs__item'

    if @props.mode == @props.currentMode
      className += ' profile-extra-tabs__item--active'

    el 'li', className: className, onClick: @_modeSwitch,
      Lang.get("users.show.extra.#{@props.mode}")


class @ProfileContentsExtra extends React.Component
  constructor: (props) ->
    super props

    @state = mode: 'recent_activities'


  componentDidMount: =>
    osu.pageChange()
    $(document).on 'profilePageExtra:tab.profileContentsExtra', @_modeSwitch


  componentWillUnmount: =>
    $(document).off '.profileContentsExtra'


  componentWillReceiveProps: =>
    osu.pageChange()


  _modeSwitch: (_e, mode) =>
    @setState mode: mode


  render: =>
    return if @props.mode == 'me'

    el 'div', className: "content content-extra flex-full",
      el 'ul', className: 'profile-extra-tabs',
        ['recent_activities', 'historical', 'beatmaps', 'kudosu', 'achievements'].map (m) =>
          el Tab, key: m, mode: m, currentMode: @state.mode

      el 'div', className: 'row-page', 'Here be extra contents.'
