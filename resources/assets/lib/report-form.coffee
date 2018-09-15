###
#    Copyright 2015-2018 ppy Pty. Ltd.
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

import { createRef, PureComponent } from 'react'
import { button, div, i, textarea } from 'react-dom-factories'

bn = 'report-form'

export class ReportForm extends PureComponent
  constructor: ->
    @ref = createRef()
    @textarea = createRef()

    @state =
      completed: false


  componentDidMount: =>
    document.addEventListener 'keydown', @handleEsc


  componentDidUpdate: (prevProps) =>
    unless prevProps.showingModal == @props.showingModal
      Blackout.toggle(@props.showingModal, 0.5)

      if @props.showingModal
        Timeout.clear @timeout
        @setState completed: false


  componentWillUnmount: =>
    document.removeEventListener 'keydown', @handleEsc


  handleEsc: (e) =>
    if e.keyCode == 27
      $.publish 'report:close'


  hideModal: (e) =>
    if !e? || (e.button == 0 && e.target == @ref.current)
      $.publish 'report:close'


  render: =>
    return null unless @props.showingModal

    title = if @state.completed
              osu.trans 'users.report.thanks'
            else
              @props.title

    div
      className: bn
      onClick: @hideModal
      key: 'form'
      ref: @ref
      div
        className: "#{bn}__content"
        div
          className: "#{bn}__header"
          div
            className: "#{bn}__row #{bn}__row--exclamation"
            i className: 'fas fa-exclamation-triangle'

          div
            className: "#{bn}__row"
            dangerouslySetInnerHTML:
              __html: "<span>#{title}</span>" # wrap in span to preserve the whitespace in text.

        @renderFormContent() if !@state.completed


  renderFormContent: =>
    div null,
      @props.children

      div
        className: "#{bn}__row"
        osu.trans 'users.report.comments'

      div
        className: "#{bn}__row"
        textarea
          className: "#{bn}__textarea"
          placeholder: osu.trans 'users.report.placeholder'
          ref: @textarea

      div
        className: "#{bn}__row #{bn}__row--buttons"
        [
          button
            className: "#{bn}__button #{bn}__button--report"
            disabled: @state.loading
            key: 'report'
            type: 'button'
            onClick: @sendReport
            osu.trans 'users.report.actions.send'

          button
            className: "#{bn}__button"
            disabled: @state.loading
            key: 'cancel'
            type: 'button'
            onClick: (e) -> $.publish 'report:close' if e.button == 0
            osu.trans 'users.report.actions.cancel'
        ]


  sendReport: =>
    @setState loading: true

    data = comments: @textarea.current.value
    _.extend data, @props.reportData if @props.reportData?

    $.ajax
      type: 'POST'
      url: @props.reportUrl
      data: data
      dataType: 'json'

    .done () =>
      @props.afterReport() if @props.afterReport?
      @timeout = Timeout.set 1000, @hideModal
      @setState completed: true

    .fail osu.ajaxError
    .always () =>
      @setState loading: false
