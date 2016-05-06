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
    maxDisplayed = 8
    achievementsProgress = (100 * @props.achievementsCounts.current / @props.achievementsCounts.total).toFixed()
    moreCount = @props.achievementsCounts.current - Math.min(@props.allAchievements.length, maxDisplayed)

    div className: 'page-contents__content profile-achievements text-center',
      div className: 'page-contents__row page-contents__row--top',
        div className: 'profile-badge profile-badge--achievements',
          span className: 'profile-badge__number',
            @props.achievementsCounts.current

        div className: 'profile-exp-bar',
          div
            className: 'profile-exp-bar--fill'
            style:
              width: "#{achievementsProgress}%"

        span className: 'profile-achievements__percentage',
          "#{achievementsProgress}%"

      div className: 'page-contents__row profile-achievements__list',
        @props.allAchievements.slice(0, maxDisplayed).map (userAchievement, i) =>
          el ProfilePage.AchievementBadge,
            key: "profile-achievement-#{i}"
            achievement: userAchievement.achievement.data
            userAchievement: userAchievement
            additionalClasses: 'badge-achievement--recent'

      if moreCount > 0
        a
          href: '#'
          onClick: @_showAllMedals
          small {},
            Lang.get('users.show.more_achievements', count: moreCount)
