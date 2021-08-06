# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Rank } from '../profile-page/rank'
import { BlockButton } from 'block-button'
import { FriendButton } from 'friend-button'
import * as React from 'react'
import { a, button, div, i, span } from 'react-dom-factories'
import { ReportReportable } from 'report-reportable'
import { nextVal } from 'utils/seq'
el = React.createElement


export class DetailBar extends React.PureComponent
  bn = 'profile-detail-bar'


  constructor: (props) ->
    super props

    @eventId = "profile-page-#{nextVal()}"
    @state = currentUser: osu.jsonClone(currentUser)


  componentDidMount: =>
    $.subscribe "user:update.#{@eventId}", @updateCurrentUser


  componentWillUnmount: =>
    $.unsubscribe ".#{@eventId}"


  render: =>
    isBlocked = _.find(@state.currentUser.blocks, target_id: @props.user.id)?

    div className: bn,
      div className: "#{bn}__column #{bn}__column--left",
        div className: "#{bn}__entry",
          el FriendButton,
            userId: @props.user.id
            showFollowerCounter: true
            followers: @props.user.follower_count
            modifiers: ['profile-page']
            alwaysVisible: true
        if @state.currentUser.id != @props.user.id && !isBlocked
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
    items = []

    if @state.currentUser.id? && @state.currentUser.id != @props.user.id
      blockButton = el BlockButton,
        key: 'block'
        userId: @props.user.id
        wrapperClass: 'simple-menu__item'
        modifiers: ['inline']
      items.push blockButton

      reportButton = el ReportReportable,
        className: 'simple-menu__item'
        icon: true
        key: 'report'
        reportableId: @props.user.id
        reportableType: 'user'
        user: @props.user
      items.push reportButton

    return null if items.length == 0

    div className: "#{bn}__entry",
      button
        className: 'btn-circle btn-circle--page-toggle btn-circle--page-toggle-detail js-click-menu'
        title: osu.trans('common.buttons.show_more_options')
        'data-click-menu-target': "profile-page-bar-#{@id}"
        span className: 'fas fa-ellipsis-v'
      div
        className: 'simple-menu simple-menu--profile-page-bar js-click-menu'
        'data-click-menu-id': "profile-page-bar-#{@id}"
        'data-visibility': 'hidden'
        items


  updateCurrentUser: (_e, user) =>
    return unless @state.currentUser.id == user.id

    @setState currentUser: osu.jsonClone(user)
