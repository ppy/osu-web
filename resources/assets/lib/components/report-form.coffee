# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Modal } from 'components/modal'
import { SelectOptions } from 'components/select-options'
import { isEmpty } from 'lodash'
import { createElement as el, createRef, PureComponent } from 'react'
import * as React from 'react'
import { button, div, i, span, textarea } from 'react-dom-factories'

bn = 'report-form'

export class ReportForm extends PureComponent
  constructor: (props) ->
    super props

    @options = [
      { id: 'Cheating', text: osu.trans 'users.report.options.cheating' },
      { id: 'MultipleAccounts', text: osu.trans 'users.report.options.multiple_accounts' },
      { id: 'Insults', text: osu.trans 'users.report.options.insults' },
      { id: 'Spam', text: osu.trans 'users.report.options.spam' },
      { id: 'UnwantedContent', text: osu.trans 'users.report.options.unwanted_content' },
      { id: 'Nonsense', text: osu.trans 'users.report.options.nonsense' },
      { id: 'Other', text: osu.trans 'users.report.options.other' },
    ]

    if props.visibleOptions?
      @options = _.intersectionWith @options, props.visibleOptions, (left, right) -> left.id == right

    @textarea = createRef()

    @state =
      selectedReason: @options[0]


  handleReasonChange: (option) =>
    @setState selectedReason: option


  render: =>
    return null if !@props.visible
    @renderForm()


  renderForm: =>
    title = if @props.completed
              osu.trans 'users.report.thanks'
            else
              @props.title

    el Modal,
      onClose: @props.onClose
      visible: @props.visible
      div
        className: bn
        div
          className: "#{bn}__header"
          div
            className: "#{bn}__row #{bn}__row--exclamation"
            i className: 'fas fa-exclamation-triangle'

          div
            className: "#{bn}__row #{bn}__row--title"
            dangerouslySetInnerHTML:
              __html: "<span>#{title}</span>" # wrap in span to preserve the whitespace in text.

        @renderFormContent() if !@props.completed


  renderFormContent: =>
    div null,
      if !isEmpty(@options)
        [
          div
            key: 'label'
            className: "#{bn}__row"
            osu.trans 'users.report.reason'

          div
            key: 'options'
            className: "#{bn}__row"
            el SelectOptions,
              blackout: false
              bn: "#{bn}-select-options"
              onChange: @handleReasonChange
              options: @options
              selected: @state.selectedReason
        ]

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
            disabled: @props.disabled
            key: 'report'
            type: 'button'
            onClick: @sendReport
            osu.trans 'users.report.actions.send'

          button
            className: "#{bn}__button"
            disabled: @props.disabled
            key: 'cancel'
            type: 'button'
            onClick: @props.onClose
            osu.trans 'users.report.actions.cancel'
        ]


  sendReport: (e) =>
    data =
      reason: @state.selectedReason?.id
      comments: @textarea.current.value

    @props.onSubmit? data
