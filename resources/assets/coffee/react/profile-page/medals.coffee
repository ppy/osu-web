# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { AchievementBadge } from './achievement-badge'
import ExtraHeader from 'profile-page/extra-header'
import * as React from 'react'
import { div, h2, h3 } from 'react-dom-factories'
el = React.createElement

export class Medals extends React.PureComponent
  render: =>
    @userAchievements = null

    all =
        for own grouping, groupedAchievements of @groupedAchievements()
          div
            key: grouping
            className: 'medals-group__group'
            h3 className: 'medals-group__title', grouping
            for own ordering, achievements of @orderedAchievements(groupedAchievements)
                div
                  key: ordering
                  className: 'medals-group__medals'
                  achievements.map @medal

    recentAchievements = @recentAchievements()

    div
      className: 'page-extra'
      el ExtraHeader, name: @props.name, withEdit: @props.withEdit

      if recentAchievements.length > 0
        div className: 'page-extra__recent-medals-box',
          div className: 'title title--page-extra-small',
            osu.trans('users.show.extra.medals.recent')
          div className: 'page-extra__recent-medals',
            for achievement in recentAchievements
              div
                className: 'page-extra__recent-medal'
                key: achievement.achievement_id
                el AchievementBadge,
                  achievement: @props.achievements[achievement.achievement_id]
                  userAchievement: achievement
                  modifiers: ['dynamic-height']

      div className: 'medals-group',
        all
      if all.length == 0
        osu.trans('users.show.extra.medals.empty')


  currentModeFilter: (achievement) =>
    !achievement.mode? || achievement.mode == @props.currentMode


  groupedAchievements: =>
    isCurrentUser = currentUser.id == @props.user.id

    _.chain(@props.achievements)
      .values()
      .filter @currentModeFilter
      .filter (a) =>
        isAchieved = @userAchievement a.id

        isAchieved || isCurrentUser
      .groupBy (a) =>
        a.grouping
      .value()


  medal: (achievement) =>
    div
      key: achievement.id
      className: 'medals-group__medal'
      el AchievementBadge,
        modifiers: ['listing']
        achievement: achievement
        userAchievement: @userAchievement achievement.id


  orderedAchievements: (achievements) =>
    _.groupBy achievements, (achievement) =>
      achievement.ordering


  recentAchievements: =>
    ret = []

    for ua in @props.userAchievements
      achievement = @props.achievements[ua.achievement_id]

      ret.push(ua) if @currentModeFilter(achievement)

      break if ret.length >= 8

    ret


  userAchievement: (id) =>
    @userAchievements ?= _.keyBy @props.userAchievements, 'achievement_id'

    @userAchievements[id]
