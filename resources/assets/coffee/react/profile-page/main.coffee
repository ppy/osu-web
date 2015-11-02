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

@ProfilePage ||= {}

class ProfilePage.Main extends React.Component
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
    $.subscribe 'user:update.profilePage', @userUpdate
    $.subscribe 'user:cover:upload:state.profilePage', @coverUploadState
    $.subscribe 'user:page:update.profilePage', @userPageUpdate
    $.subscribe 'profilePageMode:change.profilePage', @modeChange


  componentWillUnmount: =>
    @_removeListeners()


  _removeListeners: =>
    $.unsubscribe '.profilePage'

  render: =>
    stats = @props.allStats[@state.mode].data

    el 'div', className: 'flex-column flex-full flex-fullwidth',
      el ProfilePage.Header,
        user: @state.user
        stats: stats
        mode: @state.mode
        withEdit: @props.withEdit
        isCoverUpdating: @state.isCoverUpdating

      el ProfilePage.Contents,
        user: @state.user
        stats: stats
        mode: @state.mode
        recentAchievements: @props.recentAchievements

      el ProfilePage.Extra,
        recentActivities: @props.recentActivities
        recentlyReceivedKudosu: @props.recentlyReceivedKudosu
        user: @state.user
        withEdit: @props.withEdit
        userPage: @state.userPage
