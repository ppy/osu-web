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

class TeamPage.Contents extends React.Component
  componentDidMount: =>
    @componentWillReceiveProps()


  componentWillReceiveProps: ->
    osu.pageChange()

  render: =>
    tabs = ['info', 'team_members']
    if @props.team.admins.data.some((e) -> e.id == window.currentUser.id)
      tabs.push 'administration'

    div
      className: 'osu-layout__row osu-layout__row--page-profile js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
      'data-page-id': 'main'
      el 'div', className: 'page-tabs',
        tabs.map (t) =>
          el TeamPage.ContentsTab,
            key: t
            currentMode: @props.currentMode
            mode: t
      el 'div', className: 'page-contents',
        if @props.currentMode == 'info'
          el TeamPage.Info,
            team: @props.team
            withEdit: @props.withEdit
            refresh: @props.refresh
          ###
          el TeamPage.Stats, stats: @props.stats
          el TeamPage.RecentAchievements,
            achievementsCounts: @props.user.achievements
            allAchievements: @props.allAchievements
          ###
        if @props.currentMode == 'team_members'
          el TeamPage.TeamMembers,
            team: @props.team
            withEdit: @props.withEdit
            refresh: @props.refresh
        if @props.currentMode == 'administration' and @props.withEdit
          el 'div', {},
            'Not yet implemented, please wait'


