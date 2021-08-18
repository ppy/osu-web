# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { button, div, i, span } from 'react-dom-factories'
import { Spinner } from 'spinner'
import { classWithModifiers } from 'utils/css'
import { nextVal } from 'utils/seq'

el = React.createElement

bn = 'textual-button'

export class BlockButton extends React.PureComponent
  @defaultProps =
    onClick: -> # do nothing

  constructor: (props) ->
    super props

    @button = React.createRef()
    @eventId = "blockButton-#{@props.userId}-#{nextVal()}"
    @state =
      block: _.find(currentUser.blocks, target_id: props.userId)


  updateBlocks: (data) =>
    @setState block: _.find(data, target_id: @props.userId), ->
      currentUser.blocks = _.filter data, relation_type: 'block'
      currentUser.friends = _.filter data, relation_type: 'friend'
      $.publish 'user:update', currentUser
      $.publish 'blockButton:refresh'
      $.publish 'friendButton:refresh'

    @props.onClick()


  refresh: (e) =>
    @setState block: _.find(currentUser.blocks, target_id: @props.userId)


  clicked: (e) =>
    if !confirm osu.trans('common.confirmation')
      @props.onClick()
      return

    @setState loading: true, =>
      if @state.block
        #un-blocking
        @xhr = $.ajax
          type: 'DELETE'
          url: laroute.route 'blocks.destroy', block: @props.userId
      else
        #blocking
        @xhr = $.ajax
          type: 'POST'
          url: laroute.route 'blocks.store', target: @props.userId

      @xhr
      .always =>
        @setState loading: false
      .fail osu.emitAjaxError(@button.current)
      .done @updateBlocks


  componentDidMount: =>
    $.subscribe "blockButton:refresh.#{@eventId}", @refresh


  componentWillUnmount: =>
    $.unsubscribe ".#{@eventId}"
    @xhr?.abort()


  render: =>
    return null unless @isVisible()

    blockClass = classWithModifiers(bn, ['block'].concat(@props.modifiers))
    if @props.wrapperClass?
      wrapperClass = @props.wrapperClass
      contentClass = blockClass
    else
      wrapperClass = blockClass
      contentClass = null

    button
      type: 'button'
      className: wrapperClass
      onClick: @clicked
      ref: @button
      disabled: @state.loading
      span className: contentClass,
        if @state.loading
          span className: "#{bn}__icon fa-fw", el Spinner
        else
          i className: "#{bn}__icon fas fa-ban fa-fw"
        ' '
        if @state.block
          osu.trans 'users.blocks.button.unblock'
        else
          osu.trans 'users.blocks.button.block'

  isVisible: =>
    # - not a guest
    # - not viewing own profile
    currentUser.id? &&
      _.isFinite(@props.userId) &&
      @props.userId != currentUser.id
