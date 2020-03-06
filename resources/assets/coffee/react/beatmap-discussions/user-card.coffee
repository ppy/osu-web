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
import { UserAvatar } from 'user-avatar'
import UserGroupBadge from 'user-group-badge'
import { a, div, i, span } from 'react-dom-factories'

el = React.createElement
bn = 'beatmap-discussion-user-card'

export class UserCard extends React.PureComponent
  render: =>
    additionalClasses = @props.additionalClasses ? []
    hideStripe = @props.hideStripe ? false

    div
      className: osu.classWithModifiers(bn, additionalClasses)
      style: osu.groupColour(@props.badge)

      div className: "#{bn}__avatar",
        a
          className: "#{bn}__user-link"
          href: laroute.route('users.show', user: @props.user.id)
          el UserAvatar, user: @props.user, modifiers: ['full-rounded']
      div
        className: "#{bn}__user"
        div
          className: "#{bn}__user-row"
          a
            className: "#{bn}__user-link"
            href: laroute.route('users.show', user: @props.user.id)
            span
              className: "#{bn}__user-text u-ellipsis-overflow"
              @props.user.username

          if !@props.user.is_bot
            a
              className: "#{bn}__user-modding-history-link"
              href: laroute.route('users.modding.index', user: @props.user.id)
              title: osu.trans('beatmap_discussion_posts.item.modding_history_link')
              i className: 'fas fa-align-left'

        div
          className: "#{bn}__user-badge"
          el UserGroupBadge, badge: @props.badge

      if (!hideStripe)
        div
          className: "#{bn}__user-stripe"
