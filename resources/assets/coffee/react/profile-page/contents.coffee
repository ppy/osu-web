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

class ProfilePage.Contents extends React.Component
  componentDidMount: =>
    @componentWillReceiveProps()


  componentWillReceiveProps: ->
    osu.pageChange()


  render: =>
    tabs = ['osu', 'taiko', 'fruits', 'mania']

    div
      className: 'osu-layout__row osu-layout__row--page-profile js-profile-page--scrollspy js-profile-page--page'
      'data-page-id': 'main'
      el 'div', className: 'profile-tabs',
        tabs.map (t) =>
          el ProfilePage.ContentsTab,
            key: t
            currentMode: @props.currentMode
            currentPage: @props.currentPage
            mode: t
      el 'div', className: 'profile-contents flex-full flex-row',
        el ProfilePage.Info, user: @props.user
        el ProfilePage.Stats, stats: @props.stats
        el ProfilePage.RecentAchievements,
          achievementsCounts: @props.user.achievements
          allAchievements: @props.allAchievements
