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
{div, h2, h3} = React.DOM
el = React.createElement

ProfilePage.Medals = React.createClass
  mixins: [React.addons.PureRenderMixin]


  componentWillReceiveProps: ->
    @_userAchievements = null


  _userAchievement: (id) ->
    @_userAchievements ?= _.keyBy @props.achievements, (ua) => ua.achievement_id

    @_userAchievements[id]


  _groupedAchievements: ->
    achievements = _.chain(@props.achievementData)
      .values()
      .filter (a) =>
        !a.mode? || a.mode == @props.currentMode
      .value()

    _.groupBy achievements, (achievement) =>
      achievement.grouping


  _orderedAchievements: (achievements) ->
      _.groupBy achievements, (achievement) =>
        achievement.ordering


  _medal: (achievement, i) ->
    div
      key: i
      className: 'medals-group__medal'
      el ProfilePage.AchievementBadge,
        additionalClasses: 'badge-achievement--listing'
        achievement: achievement
        userAchievement: @_userAchievement achievement.id


  render: ->
    div
      className: 'profile-extra'
      el ProfilePage.ExtraHeader, name: @props.name, withEdit: @props.withEdit
      div className: 'medals-group',
        _.map @_groupedAchievements(), (groupedAchievements, grouping) =>
          div
            key: grouping
            className: 'medals-group__group'
            h3 className: 'medals-group__title', grouping
            _.map @_orderedAchievements(groupedAchievements), (achievements, ordering) =>
                div
                  key: ordering
                  className: 'medals-group__medals'
                  achievements.map @_medal
