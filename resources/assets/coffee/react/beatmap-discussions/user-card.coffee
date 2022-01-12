# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute'
import { a, div, i, span } from 'react-dom-factories'
import UserAvatar from 'user-avatar'
import UserGroupBadge from 'user-group-badge'
import { classWithModifiers } from 'utils/css'

el = React.createElement
bn = 'beatmap-discussion-user-card'

export class UserCard extends React.PureComponent
  render: =>
    additionalClasses = @props.additionalClasses ? []
    hideStripe = @props.hideStripe ? false
    linkComponent = if @props.user.is_deleted then span else a

    div
      className: classWithModifiers(bn, additionalClasses)
      style: osu.groupColour(@props.group)

      div className: "#{bn}__avatar",
        linkComponent
          className: "#{bn}__user-link"
          href: route('users.show', user: @props.user.id)
          el UserAvatar, user: @props.user, modifiers: ['full-rounded']
      div
        className: "#{bn}__user"
        div
          className: "#{bn}__user-row"
          linkComponent
            className: "#{bn}__user-link"
            href: route('users.show', user: @props.user.id)
            span
              className: "#{bn}__user-text u-ellipsis-overflow"
              @props.user.username

          if !@props.user.is_bot && !@props.user.is_deleted
            a
              className: "#{bn}__user-modding-history-link"
              href: route('users.modding.index', user: @props.user.id)
              title: osu.trans('beatmap_discussion_posts.item.modding_history_link')
              i className: 'fas fa-align-left'

        div
          className: "#{bn}__user-badge"
          el UserGroupBadge, group: @props.group

      if (!hideStripe)
        div
          className: "#{bn}__user-stripe"
