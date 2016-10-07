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
      current: @props.userAchievements.length
      total: _.size @props.achievements

    maxDisplayed = 8
    achievementsProgress = (100 * counts.current / counts.total).toFixed()

    currentUserAchievements = _.chain(@props.userAchievements)
      .map (ua) =>
        userAchievement: ua
        achievement: @props.achievements[ua.achievement_id]
      .filter (a) =>
        !a.achievement.mode? || a.achievement.mode == @props.currentMode
      .value()

    div className: 'page-contents__content profile-achievements text-center',
      div className: 'page-contents__row page-contents__row--top',
        div className: 'profile-badge profile-badge--achievements',
          span className: 'profile-badge__number',
            counts.current

        div className: 'bar bar--user-profile',
          div
            className: 'bar__fill'
            style:
              width: "#{achievementsProgress}%"

        span className: 'profile-achievements__percentage',
          "#{achievementsProgress}%"

      div className: 'page-contents__row profile-achievements__list',
        currentUserAchievements[...maxDisplayed].map (a, i) =>
          el ProfilePage.AchievementBadge,
            key: "profile-achievement-#{i}"
            achievement: a.achievement
            userAchievement: a.userAchievement
            additionalClasses: 'badge-achievement--recent'

      if currentUserAchievements.length > maxDisplayed
        a
          href: '#'
          onClick: @_showAllMedals
          small {},
            osu.trans('users.show.more_achievements')
