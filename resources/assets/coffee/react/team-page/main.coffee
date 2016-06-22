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
{div} = React.DOM
el = React.createElement

class TeamPage.Main extends React.Component
  constructor: (props) ->
    super props
    
    @state =
      team: @props.team
      isCoverUpdating: false
      currentMode: 'team_members'
  componentDidMount: =>
    #@refresh
    $.unsubscribe '.teamPage'
    $.subscribe 'team:mode:set.teamPage', @setCurrentMode
    $.subscribe 'team:update.profilePage', @refresh
  setCurrentMode: (_e, mode) =>
    return if @state.currentMode == mode
    @setState currentMode: mode
  refresh: =>
    $.ajax(laroute.route('team.get', id: @props.team.id, includes: 'admins,members')).done (data) =>
      console.log data.data
      LoadingOverlay.hide()
      @setState team: data.data
  render: ->
    div className: 'osu-layout__section',
      el TeamPage.Header,
        team: @state.team
        currentMode: @state.currentMode
        isCoverUpdating: @state.isCoverUpdating
        withEdit: @state.team.admins.data.some (e) -> e.id == window.currentUser.id
      el TeamPage.Contents,
        team: @state.team
        currentMode: @state.currentMode
        allAchievements: @props.allAchievements
        refresh: @refresh