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

el = React.createElement
{button, div, i, option, select, textarea} = ReactDOMFactories

bn = 'report-form'

class @ReportButton extends React.PureComponent
  constructor: (props) ->
    super props

    @ref = React.createRef()
    @reason = React.createRef()
    @textarea = React.createRef()

    @state =
      showingModal: false


  hideModal: (e) =>
    return if e.button != 0 || e.target != @ref.current
    e.preventDefault()
    @setState () -> showingModal: false


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
          select
            className: "#{bn}__select"
            ref: @reason
            type: 'dropdown'
            option value: 'Cheating', 'Foul play / Cheating'
            option value: 'Insults', 'Insulting me / others'
            option value: 'Spam', 'Spamming'
            option value: 'UnwantedContent', 'Linking inappropriate content (NSFW, screamers, reflinks, viruses)'
            option value: 'Nonsense', 'Nonsense'
            option value: 'Other', 'Other (type below)'

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
      reason: @reason.current.value
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
