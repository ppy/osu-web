###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
#
#    This file is part of osu!web. osu!web is distributed with the hope of
#    attracting more community contributions to the core ecosystem of osu!.
#
#    osu!web is free software: you can redistribute it and/or modify
#    it under the terms of the Affero GNU General Public License version 3
#    as published by the Free Software Foundation.
#
#    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
#    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
#    See the GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###

import * as React from 'react'
import { a, div, h1, h2, span } from 'react-dom-factories'
import { UserAvatar } from 'user-avatar'
import UserGroupBadge from 'user-group-badge'

el = React.createElement

export class Votes extends React.Component
  render: =>

    div className: 'page-extra',
      h1 className: 'title title--page-extra',
        osu.trans("users.show.extra.votes.title_longer")

      ['received', 'given'].map (direction) =>
        [
          h2
            key: "#{direction}-title"
            className: 'page-extra__subtitle',

            osu.trans("users.show.extra.votes.#{direction}")

          div
            key: direction
            className: 'modding-profile-list modding-profile-list--votes',

            if @props.votes[direction].length == 0
              div className: 'modding-profile-list__empty', osu.trans('users.show.extra.none')
            else
              [
                for vote in @props.votes[direction]
                  @renderUser(@props.users[vote.user_id], vote.score, vote.count)
              ]
        ]

  renderUser: (user, score, count) =>
    bn = 'modding-profile-vote-card'
    userBadge = user.group_badge
    topClasses = bn
    style = osu.groupColour(userBadge)

    div
      key: user.id
      className: topClasses
      style: style

      div className: "#{bn}__avatar",
        a
          className: "#{bn}__user-link"
          href: laroute.route('users.modding.index', user: user.id) + '#votes'
          el UserAvatar, user: user, modifiers: ['full-rounded']
      div
        className: "#{bn}__user"
        div
          className: "#{bn}__user-row"
          a
            className: "#{bn}__user-link"
            href: laroute.route('users.modding.index', user: user.id) + '#votes'
            span
              className: "#{bn}__user-text u-ellipsis-overflow"
              user.username

        div
          className: "#{bn}__user-badge"
          el UserGroupBadge, badge: userBadge

      div
        className: "#{bn}__user-stripe"

      div className: "#{bn}__votes-container",
        div className: "#{bn}__score", if score > 0 then "+#{score}" else score
        div className: "#{bn}__count", osu.transChoice('users.show.extra.votes.vote_count', count)
