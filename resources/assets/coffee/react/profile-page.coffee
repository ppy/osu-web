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
      mode: props.initialMode
      user: props.user
      userPage:
        html: props.userPage.html
        initialRaw: props.userPage.raw
        raw: props.userPage.raw
        editing: false
        selection: [0, 0]
      isCoverUpdating: false


  coverChangeDefault: (_e, coverId) =>
    $.ajax window.changeCoverUrl,
      method: 'PUT'
      data:
        cover_id: coverId
      dataType: 'json'
    .done (userData) =>
      @userUpdate null, userData.data


  coverUploadState: (_e, state) =>
    @setState isCoverUpdating: state


  modeChange: (e) =>
    e.preventDefault()

    @setState mode: e.target.getAttribute('data-mode')


  userUpdate: (_e, user) =>
    return unless user != undefined && user != null
    @setState user: user


  userPageUpdate: (_e, newUserPage) =>
    currentUserPage = @state.userPage
    @setState userPage: _.extend(currentUserPage, newUserPage)


  componentDidMount: =>
    $(document).off 'profile'
    $(document).on 'profile.user.update', @userUpdate
    $(document).on 'profile.cover.select', @coverChangeDefault
    $(document).on 'profile.cover.upload.state', @coverUploadState
    $(document).on 'profile.user-page.update', @userPageUpdate


  componentWillUnmount: =>
    $(document).off 'profile'


  render: =>
    if @state.mode != 'me'
      headerMode = @state.mode
      headerStats = stats = @props.allStats[@state.mode].data
    else
      headerMode = @state.initialMode
      headerStats = @props.allStats[headerMode].data

    el 'div', className: 'flex-column flex-full',
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
        modeChange: @modeChange
        recentAchievements: @props.recentAchievements
        achievementsCounts: @props.achievementsCounts
        withEdit: @props.withEdit


user = osu.parseJson('json-user-info').data

React.render \
  el(ProfilePage,
    user: user
    userPage: osu.parseJson('json-user-page').page
    allStats: osu.parseJson('json-user-stats')
    initialMode: window.userPlaymode
    withEdit: user.id == @user?.user_id
    recentAchievements: osu.parseJson('json-user-recent-achievements').data
    achievementsCounts: osu.parseJson('json-user-achievements-counts')
  ), document.getElementsByClassName('content')[0]
