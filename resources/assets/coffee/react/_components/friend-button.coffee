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
import { button, div, i, span } from 'react-dom-factories'
import { Spinner } from 'spinner'
el = React.createElement

bn = 'user-action-button'

export class FriendButton extends React.PureComponent
  @defaultProps =
    showFollowerCounter: false
    alwaysVisible: false


  constructor: (props) ->
    super props

    @button = React.createRef()
    @eventId = "friendButton-#{@props.userId}-#{osu.uuid()}"

    friend = _.find(currentUser.friends, target_id: props.userId)
    followersWithoutSelf = @props.followers ? 0
    followersWithoutSelf -= 1 if friend?

    @state = {friend, followersWithoutSelf}


  requestDone: =>
    @setState loading: false


  updateFriends: (data) =>
    @setState friend: _.find(data, target_id: @props.userId), ->
      currentUser.friends = data
      $.publish 'user:update', currentUser
      $.publish "friendButton:refresh"


  clicked: (e) =>
    @setState loading: true

    if @state.friend?
      #un-friending
      @xhr = $.ajax
        type: "DELETE"
        url: laroute.route 'friends.destroy', friend: @props.userId
    else
      #friending
      @xhr = $.ajax
        type: "POST"
        url: laroute.route 'friends.store', target: @props.userId

    @xhr
    .done @updateFriends
    .fail osu.emitAjaxError(@button.current)
    .always @requestDone


  refresh: (e) =>
    @setState
      friend: _.find(currentUser.friends, target_id: @props.userId), =>
      @forceUpdate()


  componentDidMount: =>
    $.subscribe "friendButton:refresh.#{@eventId}", @refresh


  componentWillUnmount: =>
    $.unsubscribe ".#{@eventId}"
    @xhr?.abort()


  render: =>
    isVisible = @isVisible()

    if !@props.alwaysVisible
      if isVisible
        @props.container?.classList.remove 'hidden'
      else
        @props.container?.classList.add 'hidden'

        return null

    blockClass = osu.classWithModifiers(bn, @props.modifiers)

    isFriendLimit = (currentUser.friends?.length ? 0) >= currentUser.max_friends
    title = switch
      when !isVisible
        osu.trans('friends.buttons.disabled')
      when @state.friend?
        osu.trans('friends.buttons.remove')
      when isFriendLimit
        osu.trans('friends.too_many')
      else
        osu.trans('friends.buttons.add')

    disabled = !isVisible || @state.loading || isFriendLimit && !@state.friend?

    if @state.friend? && !@state.loading
      if @state.friend.mutual
        blockClass += " #{bn}--mutual"
      else
        blockClass += " #{bn}--friend"

    div
      title: title
      button
        type: 'button'
        className: blockClass
        onClick: @clicked
        ref: @button
        disabled: disabled
        @renderIcon({isFriendLimit, isVisible})
        @renderCounter()


  renderCounter: =>
    return unless @props.showFollowerCounter && @props.followers?

    span className: "#{bn}__counter", osu.formatNumber(@followers())


  renderIcon: ({isFriendLimit, isVisible}) =>
    span className: "#{bn}__icon-container",
      switch
        when @state.loading
          el Spinner
        when !isVisible
          i className: 'fas fa-user'
        when @state.friend?
          [
            span
              key: 'hover'
              className: "#{bn}__icon #{bn}__icon--hover-visible"
              i className: 'fas fa-user-times'
            if @state.friend.mutual
              span
                key: 'normal-mutual'
                className: "#{bn}__icon #{bn}__icon--hover-hidden"
                i className: 'fas fa-user-friends'
            else
              span
                key: 'normal'
                className: "#{bn}__icon #{bn}__icon--hover-hidden"
                i className: 'fas fa-user'
          ]
        else
          i className: if isFriendLimit then 'fas fa-user' else 'fas fa-user-plus'


  followers: =>
    @state.followersWithoutSelf + (if @state.friend? then 1 else 0)


  isVisible: =>
    # - not a guest
    # - not viewing own card
    # - not blocked
    currentUser.id? &&
      _.isFinite(@props.userId) &&
      @props.userId != currentUser.id &&
      !_.find(currentUser.blocks, target_id: @props.userId)
