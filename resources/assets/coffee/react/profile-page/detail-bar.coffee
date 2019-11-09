###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import { Rank } from './rank'
import { BlockButton } from 'block-button'
import { FriendButton } from 'friend-button'
import * as React from 'react'
import { a, button, div, dd, dl, dt, h1, i, img, li, span, ul } from 'react-dom-factories'
import { ReportReportable } from 'report-reportable'
el = React.createElement


export class DetailBar extends React.PureComponent
  bn = 'profile-detail-bar'


  constructor: (props) ->
    super props

    @eventId = "profile-page-#{osu.uuid()}"
    @state = currentUser: osu.jsonClone(currentUser)


  componentDidMount: =>
    $.subscribe "user:update.#{@eventId}", @updateCurrentUser


  componentWillUnmount: =>
    $.unsubscribe ".#{@eventId}"


  render: =>
    isBlocked = _.find(@state.currentUser.blocks, target_id: @props.user.id)?

    div className: bn,
      div className: "#{bn}__page-toggle",
        button
          className: 'profile-page-toggle'
          onClick: @props.toggleExtend
          title: osu.trans("common.buttons.#{if @props.expanded then 'collapse' else 'expand'}")
          if @props.expanded
            span className: 'fas fa-chevron-up'
          else
            span className: 'fas fa-chevron-down'

      div className: "#{bn}__column #{bn}__column--left",
        div className: "#{bn}__menu-item",
          el FriendButton,
            userId: @props.user.id
            showFollowerCounter: true
            followers: @props.user.follower_count
            modifiers: ['profile-page']
            alwaysVisible: true
        if @state.currentUser.id != @props.user.id && !isBlocked
          div className: "#{bn}__menu-item",
            a
              className: 'user-action-button user-action-button--profile-page'
              href: laroute.route 'messages.users.show', user: @props.user.id
              title: osu.trans('users.card.send_message')
              i className: 'fas fa-envelope'

        @renderExtraMenu()

      div className: "#{bn}__column #{bn}__column--right",
        if @props.expanded
          div
            title: osu.trans('users.show.stats.level_progress')
            className: "#{bn}__entry #{bn}__entry--level-progress"
            div className: 'bar bar--user-profile',
              div
                className: 'bar__fill'
                style:
                  width: "#{@props.stats.level.progress}%"
              div className: "bar__text",
                "#{@props.stats.level.progress}%"

        if !@props.expanded
          div className: "#{bn}__entry #{bn}__entry--ranking",
            el Rank, type: 'global', stats: @props.stats

        if !@props.expanded
          div className: "#{bn}__entry #{bn}__entry--ranking",
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

    div className: "#{bn}__menu-item",
      button
        className: 'profile-page-toggle js-click-menu'
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
