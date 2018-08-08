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
import { button, div, i, option, select, textarea } from 'react-dom-factories'
import { SelectOptions } from 'select-options'

bn = 'report-form'
options = [
  { id: 'Cheating', text: 'Foul play / Cheating' },
  { id: 'Insults', text: 'Insulting me / others' },
  { id: 'Spam', text: 'Spamming' },
  { id: 'UnwantedContent', text: 'Linking inappropriate content (NSFW, screamers, reflinks, viruses)' },
  { id: 'Nonsense', text: 'Nonsense' },
  { id: 'Other', text: 'Other (type below)' },
]

export class ReportButton extends PureComponent
  constructor: (props) ->
    super props

    @ref = createRef()
    @textarea = createRef()

    @state =
      selectedReason: options[0]
      showingModal: false


  hideModal: (e) =>
    return if e.button != 0 || e.target != @ref.current
    e.preventDefault()
    @setState () -> showingModal: false


  onItemSelected: (item) =>
    @setState () -> selectedReason: item


  render: =>
    return null unless currentUser.id? && @props.user?.id != currentUser.id

    [
      button
        className: 'user-action-button user-action-button--message user-action-button--right-margin',
        key: 'button'
        type: 'button'
        onClick: @showModal
        title: 'report user'
        i className: 'fas fa-exclamation-triangle',

      @renderForm() if @state.showingModal
    ]


  renderForm: =>
    options = [
      { id: 'Cheating', text: 'Foul play / Cheating' },
      { id: 'Insults', text: 'Insulting me / others' },
      { id: 'Spam', text: 'Spamming' },
      { id: 'UnwantedContent', text: 'Linking inappropriate content (NSFW, screamers, reflinks, viruses)' },
      { id: 'Nonsense', text: 'Nonsense' },
      { id: 'Other', text: 'Other (type below)' },
    ]

    div
      className: bn
      key: 'form'
      onClick: @hideModal
      ref: @ref
      div
        className: "#{bn}__form"
        div
          className: "#{bn}__header"
          div
            className: "#{bn}__row"
            i className: 'fas fa-exclamation-triangle'

          div
            className: "#{bn}__row"
            "Report #{@props.user.username}?"

        div
          className: "#{bn}__row"
          'Reason'

        div
          className: "#{bn}__row"
          el SelectOptions,
            bn: "#{bn}-select-options"
            onItemSelected: @onItemSelected
            options: options
            selected: @state.selectedReason

        div
          className: "#{bn}__row"
          'Additional Comments'

        div
          className: "#{bn}__row"
          textarea
            className: "#{bn}__textarea"
            placeholder: 'Please provide any information you believe could be useful.'
            ref: @textarea

        div
          className: "#{bn}__row"
          button
            className: "#{bn}__button #{bn}__button--report"
            disabled: @state.loading
            type: 'button'
            onClick: @sendReport
            'Send Report'

        div
          className: "#{bn}__row"
          button
            className: "#{bn}__button"
            disabled: @state.loading
            type: 'button'
            onClick: () => @setState showingModal: false
            'Cancel'


  showModal: (e) =>
    return if e.button != 0
    e.preventDefault()
    @setState () -> showingModal: true


  sendReport: (e) =>
    @setState () -> loading: true

    data =
      reason: @state.selectedReason.id
      comments: @textarea.current.value

    $.ajax
      type: 'POST'
      url: laroute.route 'users.report', user: @props.user.id
      data: data

    .done () =>
      @setState () -> showingModal: false

    .fail osu.ajaxError
    .always () =>
      @setState () -> loading: false
