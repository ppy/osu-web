# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Rank } from '../profile-page/rank'
import { FriendButton } from 'friend-button'
import core from 'osu-core-singleton'
import { Observer } from 'mobx-react'
import ExtraMenu, { showExtraMenu } from 'profile-page/extra-menu'
import * as React from 'react'
import { a, button, div, i, span } from 'react-dom-factories'
import { jsonClone } from 'utils/json'
import { nextVal } from 'utils/seq'

bn = 'profile-detail-bar'
el = React.createElement

export class DetailBar extends React.PureComponent
  render: =>
    el Observer, null, =>
      isBlocked = core.currentUser? && _.find(core.currentUser.blocks, target_id: @props.user.id)?

      div className: bn,
        div className: "#{bn}__column #{bn}__column--left",
          div className: "#{bn}__entry",
            el FriendButton,
              userId: @props.user.id
              showFollowerCounter: true
              followers: @props.user.follower_count
              modifiers: ['profile-page']
              alwaysVisible: true
          if !core.currentUser? || (core.currentUser.id != @props.user.id && !isBlocked)
            div className: "#{bn}__entry",
              a
                className: 'user-action-button user-action-button--profile-page'
                href: laroute.route 'messages.users.show', user: @props.user.id
                title: osu.trans('users.card.send_message')
                i className: 'fas fa-envelope'

          @renderExtraMenu()

        div className: "#{bn}__column #{bn}__column--right",
          div className: "#{bn}__entry",
            el Rank, type: 'global', stats: @props.stats

          div className: "#{bn}__entry",
            el Rank, type: 'country', stats: @props.stats

          div className: "#{bn}__entry #{bn}__entry--level",
            div
              className: "#{bn}__level"
              title: osu.trans('users.show.stats.level', level: @props.stats.level.current)
              @props.stats.level.current


  renderExtraMenu: =>
    return null unless showExtraMenu(@props.user)

    div className: "#{bn}__entry",
      el ExtraMenu,
        user: @props.user
