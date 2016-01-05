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

class ProfilePage.RecentAchievements extends React.Component
  render: =>
    maxDisplayed = 8
    achievementsProgress = (100 * @props.achievementsCounts.current / @props.achievementsCounts.total).toFixed()
    moreCount = @props.achievementsCounts.current - Math.min(@props.allAchievements.length, maxDisplayed)

    el 'div', className: 'profile-content flex-col-33 text-center',
      el 'div', className: 'profile-row profile-row--top',
        el 'div', className: 'profile-achievements-badge profile-top-badge',
          el 'span', className: 'profile-badge-number',
            @props.achievementsCounts.current

        el 'div', className: 'profile-exp-bar',
          el 'div',
            className: 'profile-exp-bar-fill'
            style:
              width: "#{achievementsProgress}%"

        el 'dl', className: 'profile-stats profile-stats--light',
          el 'dt'
          el 'dd', null, "#{achievementsProgress}%"

      el 'div', className: 'profile-row profile-recent-achievements',
        @props.allAchievements.slice(0, maxDisplayed).map (userAchievement, i) =>
          el ProfilePage.AchievementBadge,
            key: "profile-achievement-#{i}"
            achievement: userAchievement.achievement.data
            additionalClasses: 'badge-achievement--recent'

      if moreCount > 0
        el 'small', null,
          Lang.get('users.show.more_achievements', count: moreCount)
