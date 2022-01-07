# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import ProfilePageExtraSectionTitle from 'components/profile-page-extra-section-title'
import * as React from 'react'
import { a, div, h1, h2, span } from 'react-dom-factories'
import UserAvatar from 'user-avatar'
import UserGroupBadge from 'user-group-badge'

el = React.createElement

export class Votes extends React.Component
  render: =>

    div className: 'page-extra',
      h1 className: 'title title--page-extra',
        osu.trans("users.show.extra.votes.title_longer")

      for direction in ['received', 'given']
        el React.Fragment, key: direction,
          el ProfilePageExtraSectionTitle,
            count: if @props.votes[direction].length == 0 then 0 else null
            titleKey: "users.show.extra.votes.#{direction}"

          if @props.votes[direction].length > 0
            div
              className: 'modding-profile-list modding-profile-list--votes'
              for vote in @props.votes[direction]
                @renderUser(@props.users[vote.user_id], vote.score, vote.count)


  renderUser: (user, score, count) =>
    bn = 'modding-profile-vote-card'
    userBadge = user.groups?[0]
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
