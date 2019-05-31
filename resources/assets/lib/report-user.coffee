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

import { createElement as el, PureComponent } from 'react'
import * as React from 'react'
import { button, span, i } from 'react-dom-factories'
import { ReportForm } from 'report-form'

bn = 'textual-button'

export class ReportUser extends PureComponent
  @defaultProps =
    onFormClose: -> # do nothing

  constructor: (props) ->
    super props

    @state =
      completed: false
      disabled: false
      showingForm: false


  render: =>
    return null unless currentUser.id? && @props.user?.id != currentUser.id

    blockClass = osu.classWithModifiers(bn, @props.modifiers)
    if @props.wrapperClass?
      wrapperClass = @props.wrapperClass
      contentClass = blockClass
    else
      wrapperClass = blockClass
      contentClass = null

    [
      button
        className: wrapperClass
        key: 'button'
        onClick: @showForm
        type: 'button'
        span className: contentClass,
          i className: "#{bn}__icon fas fa-exclamation-triangle"
          ' '
          osu.trans 'users.report.button_text'

      el ReportForm,
        completed: @state.completed
        disabled: @state.disabled
        key: 'form'
        onClose: @onFormClose
        onSubmit: @onSubmit
        title: osu.trans 'users.report.title', username: "<strong>#{@props.user.username}</strong>"
        visible: @state.showingForm
    ]


  onFormClose: =>
    @props.onFormClose()

    @setState
      disabled: false
      showingForm: false


  showForm: (e) =>
    return if e.button != 0
    e.preventDefault()

    Timeout.clear @timeout
    @setState
      completed: false
      showingForm: true


  onSubmit: (data) =>
    @setState disabled: true

    $.ajax
      type: 'POST'
      url: laroute.route 'users.report', user: @props.user.id
      data: data
      dataType: 'json'

    .done () =>
      @timeout = Timeout.set 1000, @onFormClose
      @setState completed: true

    .fail (xhr) =>
      osu.ajaxError xhr
      @setState disabled: false
