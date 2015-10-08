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

class ProfilePage.Contents extends React.Component
  componentDidMount: =>
    @componentWillReceiveProps()


  componentWillReceiveProps: ->
    osu.pageChange()


  render: =>
    tabs = ['osu', 'taiko', 'ctb', 'mania']

    mainClass = 'row-page row-page--profile flex-column'
    if @props.mode == 'me'
      mainClass += ' flex-full'

    el 'div', className: mainClass,
      el 'div', className: 'profile-tabs',
        tabs.map (t) =>
          el ProfilePage.ContentsTab,
            key: t
            currentMode: @props.mode
            mode: t
      el 'div', className: 'profile-contents flex-full flex-row',
        el ProfilePage.Info, user: @props.user
        el ProfilePage.Stats, stats: @props.stats
        el ProfilePage.RecentAchievements,
          achievementsCounts: @props.user.achievements
          recentAchievements: @props.recentAchievements
