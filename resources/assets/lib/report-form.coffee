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

import { createElement as el, createRef, PureComponent } from 'react'
import { button, div, i, span, textarea } from 'react-dom-factories'
import { SelectOptions } from 'select-options'

bn = 'report-form'

export class ReportForm extends PureComponent
  constructor: (props) ->
    super props

    @options = [
      { id: 'Cheating', text: osu.trans 'users.report.options.cheating' },
      { id: 'Insults', text: osu.trans 'users.report.options.insults' },
      { id: 'Spam', text: osu.trans 'users.report.options.spam' },
      { id: 'UnwantedContent', text: osu.trans 'users.report.options.unwanted_content' },
      { id: 'Nonsense', text: osu.trans 'users.report.options.nonsense' },
      { id: 'Other', text: osu.trans 'users.report.options.other' },
    ]

    @ref = createRef()
    @textarea = createRef()

    @state =
      selectedReason: @options[0]
      showingModal: false


  componentDidMount: =>
    document.addEventListener 'keydown', @handleEsc


  componentDidUpdate: (_prevProps, prevState) =>
    Blackout.toggle(@state.showingModal, 0.5) unless prevState.showingModal == @state.showingModal


  componentWillUnmount: =>
    document.removeEventListener 'keydown', @handleEsc


  handleEsc: (e) =>
    if e.keyCode == 27
      @setState showingModal: false


  hideModal: (e) =>
    if !e? || (e.button == 0 && e.target == @ref.current)
      @setState showingModal: false


  onItemSelected: (item) =>
    @setState selectedReason: item


  render: =>
    return null unless currentUser.id? && @props.user?.id != currentUser.id

    [
      button
        className: 'textual-button',
        key: 'button'
        type: 'button'
        onClick: @showModal
        span null,
          i className: 'textual-button__icon fas fa-exclamation-triangle'
          " #{osu.trans 'users.report.button_text'}"

      @renderForm() if @state.showingModal
    ]


  renderForm: =>
    title = if @state.completed
              osu.trans 'users.report.thanks'
            else
              osu.trans 'users.report.title', username: "<strong>#{@props.user.username}</strong>"

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
      div
        className: "#{bn}__row"
        osu.trans 'users.report.reason'

      div
        className: "#{bn}__row"
        el SelectOptions,
          blackout: false
          bn: "#{bn}-select-options"
          onItemSelected: @onItemSelected
          options: @options
          selected: @state.selectedReason

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
            onClick: () => @setState showingModal: false
            osu.trans 'users.report.actions.cancel'
        ]


  showModal: (e) =>
    return if e.button != 0
    e.preventDefault()
    Timeout.clear @timeout
    @setState
      completed: false
      showingModal: true


  sendReport: (e) =>
    @setState loading: true

    data =
      reason: @state.selectedReason.id
      comments: @textarea.current.value

    $.ajax
      type: 'POST'
      url: laroute.route 'users.report', user: @props.user.id
      data: data
      dataType: 'json'

    .done () =>
      @timeout = Timeout.set 1000, @hideModal
      @setState completed: true

    .fail osu.ajaxError
    .always () =>
      @setState loading: false
