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
{div, h2} = React.DOM
el = React.createElement

ProfilePage.Medals = React.createClass
  mixins: [React.addons.PureRenderMixin]


  componentWillReceiveProps: ->
    @_achieved = null


  _isAchieved: (id) ->
    @_achieved ||= @props.allAchievements.map (achieved) ->
      achieved.achievement.data.id

    @_achieved.includes id


  render: ->
    groupedAchievements = _.groupBy @props.achievements, (achievement) ->
      achievement.grouping

    achievementsHtml = []

    for own group, achievements of groupedAchievements
      achievementsHtml.push div key: group,
          "Group: #{group}"
          achievements.map (achievement, i) =>
            div
              key: i
              el ProfilePage.AchievementBadge,
                achievement: achievement
                isLocked: !@_isAchieved(achievement.id)

    div
      className: 'profile-extra'
      div className: 'profile-extra__anchor js-profile-page-extra--scrollspy', id: 'medals'

      h2 className: 'profile-extra__title', Lang.get('users.show.extra.medals.title')

      achievementsHtml
