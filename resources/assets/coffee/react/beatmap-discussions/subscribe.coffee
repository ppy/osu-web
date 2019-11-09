###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import { BigButton } from 'big-button'
import * as React from 'react'
import { a, button, div, h1, h2, p } from 'react-dom-factories'
el = React.createElement

export class Subscribe extends React.PureComponent
  constructor: (props) ->
    super props

    @state = loading: false


  componentWillUnmount: =>
    @xhr?.abort()


  render: =>
    el BigButton,
      text: osu.trans "common.buttons.watch.to_#{+!@isWatching()}"
      icon: if @isWatching() then 'fas fa-eye-slash' else 'fas fa-eye'
      modifiers: ['full']
      props:
        onClick: @toggleWatch
        disabled: @state.loading


  isWatching: =>
    @props.beatmapset.current_user_attributes?.is_watching


  toggleWatch: =>
    @setState loading: true

    @xhr = $.ajax laroute.route('beatmapsets.watches.update', watch: @props.beatmapset.id),
      type: if @isWatching() then 'DELETE' else 'PUT'
      dataType: 'json'
    .done (data) =>
      $.publish 'beatmapsetDiscussions:update', watching: !@isWatching()
    .fail (xhr) =>
      osu.emitAjaxError() xhr
    .always =>
      @setState loading: false
