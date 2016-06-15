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
    @timeouts = {}
    
    @state =
      team: $.ajax laroute.route('team.get'),
        method: 'get'
      .done (data) =>
        return data
      isCoverUpdating: false
      currentMode: 'team_members'
  componentDidMount: =>
    $.unsubscribe '.teamPage'
    $.subscribe 'team:mode:set.teamPage', @setCurrentMode

  setCurrentMode: (_e, mode) =>
    return if @state.currentMode == mode
    @setState currentMode: mode
  render: ->
    div className: 'osu-layout__section',
      el TeamPage.Header,
        team: @state.team
        currentMode: @state.currentMode
        isCoverUpdating: @state.isCoverUpdating
      el TeamPage.Contents,
        team: @state.team
        currentMode: @state.currentMode
        allAchievements: @props.allAchievements