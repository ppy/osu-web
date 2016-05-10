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
{a, dd, dl, div, dt, small, span} = React.DOM
el = React.createElement

class ProfilePage.RecentAchievements extends React.Component
  _showAllMedals: (e) =>
    e.preventDefault()

    $.publish 'profile:page:jump', 'medals'


  render: =>
    counts =
      current: @props.achievements.length
      total: _.size @props.achievementData

    maxDisplayed = 8
    achievementsProgress = (100 * counts.current / counts.total).toFixed()

    currentAchievements = _.chain(@props.achievements)
      .map (ua) =>
        userAchievement: ua
        achievement: @props.achievementData[ua.achievement_id]
      .filter (a) =>
        !a.achievement.mode? || a.achievement.mode == @props.currentMode
      .value()

    div className: 'profile-content flex-col-33 text-center',
      div className: 'profile-row profile-row--top',
        div className: 'profile-achievements-badge profile-top-badge',
          span className: 'profile-badge-number',
            counts.current

        div className: 'profile-exp-bar',
          div
            className: 'profile-exp-bar-fill'
            style:
              width: "#{achievementsProgress}%"

        dl className: 'profile-stats profile-stats--light',
          dt()
          dd {}, "#{achievementsProgress}%"

      div className: 'profile-row profile-recent-achievements',
        currentAchievements.slice(0, maxDisplayed).map (a, i) =>
          el ProfilePage.AchievementBadge,
            key: "profile-achievement-#{i}"
            achievement: a.achievement
            userAchievement: a.userAchievement
            additionalClasses: 'badge-achievement--recent'

      if currentAchievements.length > maxDisplayed
        a
          href: '#'
          onClick: @_showAllMedals
          small {},
            Lang.get('users.show.more_achievements')
