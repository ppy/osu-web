# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { button, span } from 'react-dom-factories'
import { classWithModifiers } from 'utils/css'

bn = 'profile-cover-selection'

export class CoverSelection extends React.PureComponent
  render: =>
    button
      className: classWithModifiers(bn, @props.modifiers)
      style:
        backgroundImage: osu.urlPresence(@props.thumbUrl)
      onClick: @onClick
      onMouseEnter: @onMouseEnter
      onMouseLeave: @onMouseLeave
      if @props.isSelected
        span className: 'profile-cover-selection__selected',
          span className: 'far fa-check-circle'


  onClick: (e) =>
    return if !@props.url?

    $.publish 'user:cover:upload:state', [true]

    $.ajax laroute.route('account.cover'),
      method: 'post'
      data:
        cover_id: @props.name
      dataType: 'json'
    .always ->
      $.publish 'user:cover:upload:state', [false]
    .done (userData) ->
      $.publish 'user:update', userData
    .fail osu.emitAjaxError(e.target)


  onMouseEnter: =>
    return if !@props.url?

    $.publish 'user:cover:set', @props.url


  onMouseLeave: ->
    $.publish 'user:cover:reset'
