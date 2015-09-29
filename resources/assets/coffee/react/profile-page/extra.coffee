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

class ProfilePage.Extra extends React.Component
  constructor: (props) ->
    super props

    @state =
      mode: 'recent_activities'
      tabsSticky: false


  componentDidMount: =>
    @_removeListeners()
    $(document).on 'profilePageExtra:tab.profileContentsExtra', @_modeSwitch
    $(document).on 'stickyHeader.profileContentsExtra', @_tabsStick
    $(window).on 'scroll.profileContentsExtra', @_modeScan
    osu.pageChange()


  componentWillUnmount: =>
    @_removeListeners()


  componentWillReceiveProps: =>
    osu.pageChange()


  _modeScan: =>
    for page in document.getElementsByClassName('js-scrollspy') by -1
      continue unless page.getBoundingClientRect().top <= 0

      @setState mode: page.getAttribute('id')
      return

    @setState mode: page.getAttribute('id')


  _modeSwitch: (_e, mode) =>
    $.scrollTo "##{mode}", 500,
      onAfter: => @setState mode: mode


  _removeListeners: ->
    $(document).off '.profileContentsExtra'
    $(window).off '.profileContentsExtra'


  _tabsStick: (_e, target) =>
    @setState tabsSticky: (target == 'profile-extra-tabs')


  render: =>
    return if @props.mode == 'me'

    tabsClasses = 'profile-extra-tabs__items'
    if @state.tabsSticky
      tabsClasses += ' profile-extra-tabs__items--fixed js-sticky-header--active'

    el 'div', className: "content content-extra flex-full",
      el 'div',
        className: 'profile-extra-tabs js-sticky-header'
        'data-sticky-header-target': 'profile-extra-tabs'
        el 'div',
          className: tabsClasses
          'data-sticky-header-id': 'profile-extra-tabs'
          ['recent_activities', 'kudosu'].map (m) =>
            el ProfilePage.ExtraTab, key: m, mode: m, currentMode: @state.mode

      el ProfilePage.RecentActivities
      el ProfilePage.Kudosu, user: @props.user, recentlyReceivedKudosu: @props.recentlyReceivedKudosu
