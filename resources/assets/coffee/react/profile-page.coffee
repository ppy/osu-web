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

class @ProfilePage extends React.Component
  constructor: (props) ->
    super props

    @state =
      mode: props.user.playmode
      user: props.user
      userPage:
        html: props.userPage.html
        initialRaw: props.userPage.raw
        raw: props.userPage.raw
        editing: false
        selection: [0, 0]
      isCoverUpdating: false


  coverUploadState: (_e, state) =>
    @setState isCoverUpdating: state


  modeChange: (_e, mode) =>
    @setState mode: mode


  userUpdate: (_e, user) =>
    return unless user != undefined && user != null
    @setState user: user


  userPageUpdate: (_e, newUserPage) =>
    currentUserPage = @state.userPage
    @setState userPage: _.extend(currentUserPage, newUserPage)


  componentDidMount: =>
    @_removeListeners()
    $(document).on 'user:update.profilePage', @userUpdate
    $(document).on 'user:cover:upload:state.profilePage', @coverUploadState
    $(document).on 'user:page:update.profilePage', @userPageUpdate
    $(document).on 'profilePageMode:change.profilePage', @modeChange


  componentWillUnmount: =>
    @_removeListeners()


  _removeListeners: =>
    $(document).off '.profilePage'

  render: =>
    if @state.mode != 'me'
      headerMode = @state.mode
      headerStats = stats = @props.allStats[@state.mode].data
    else
      headerMode = @props.user.playmode
      headerStats = @props.allStats[headerMode].data

    el 'div', className: 'flex-column flex-full flex-fullwidth',
      el ProfileHeader,
        user: @state.user
        stats: headerStats
        mode: headerMode
        withEdit: @props.withEdit
        isCoverUpdating: @state.isCoverUpdating

      el ProfileContents,
        user: @state.user
        userPage: @state.userPage
        stats: stats
        mode: @state.mode
        recentAchievements: @props.recentAchievements
        withEdit: @props.withEdit

      if @state.mode != 'me'
        el ProfileContentsExtra


user = osu.parseJson('json-user-info').data

React.render \
  el(ProfilePage,
    user: user
    userPage: osu.parseJson('json-user-page').page
    allStats: osu.parseJson('json-user-stats')
    withEdit: user.id == window.currentUser.id
    recentAchievements: osu.parseJson('json-user-recent-achievements').data
  ), document.getElementsByClassName('content')[0]
