###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import { BigButton } from 'big-button'
import * as React from 'react'
import { button, div, span } from 'react-dom-factories'
import { Spinner } from 'spinner'
import { UserAvatar } from 'user-avatar'
el = React.createElement

bn = 'comment-editor'

export class CommentEditor extends React.PureComponent
  constructor: (props) ->
    super props

    @textarea = React.createRef()
    @throttledPost = _.throttle @post, 1000

    @handleKeyDown = InputHandler.textarea @handleKeyDownCallback

    @state =
      message: @props.message ? ''
      posting: false


  componentDidMount: =>
    @textarea.current?.selectionStart = -1
    @textarea.current?.focus() if (@props.focus ? true)


  componentWillUnmount: =>
    @throttledPost.cancel()
    @xhr?.abort()


  render: =>
    blockClass = osu.classWithModifiers bn, @props.modifiers
    blockClass += " #{bn}--fancy" if @mode() == 'new'

    div className: blockClass,
      if @mode() == 'new'
        div className: "#{bn}__avatar",
          el UserAvatar, user: currentUser, modifiers: ['full-circle']

      el TextareaAutosize,
        className: "#{bn}__message"
        ref: @textarea
        value: @state.message
        placeholder: osu.trans("comments.placeholder.#{@mode()}")
        onChange: @onChange
        onKeyDown: @handleKeyDown
        disabled: !currentUser.id? || @state.posting
      div
        className: "#{bn}__footer"
        div className: "#{bn}__footer-item #{bn}__footer-item--notice hidden-xs",
          osu.trans 'comments.editor.textarea_hint._',
            action: osu.trans("comments.editor.textarea_hint.#{@mode()}")

        if @props.close?
          div className: "#{bn}__footer-item",
            el BigButton,
              modifiers: ['comment-editor']
              text: osu.trans('common.buttons.cancel')
              props:
                onClick: @props.close
                disabled: @state.posting

        if currentUser.id?
          div className: "#{bn}__footer-item",
            el BigButton,
              modifiers: ['comment-editor']
              text:
                if @state.posting
                  el Spinner
                else
                  @buttonText()
              props:
                onClick: @throttledPost
                disabled: @state.posting || !@isValid()
        else
          div className: "#{bn}__footer-item",
            el BigButton,
              modifiers: ['comment-editor']
              extraClasses: ['js-user-link']
              text: osu.trans("comments.guest_button.#{@mode()}")


  buttonText: =>
    key =
      switch @mode()
        when 'reply' then 'reply'
        when 'edit' then 'save'
        when 'new' then 'post'

    osu.trans("common.buttons.#{key}")


  close: =>
    return unless @props.close?

    initialMessage = @props.message ? ''

    return if initialMessage != @state.message && !confirm(osu.trans('common.confirmation_unsaved'))

    @props.close()


  handleKeyDownCallback: (type, event) =>
    switch type
      when InputHandler.CANCEL
        @close()
      when InputHandler.SUBMIT
        @throttledPost()


  isValid: =>
    @state.message? && @state.message.length > 0


  mode: =>
    if @props.parent?
      'reply'
    else if @props.id?
      'edit'
    else
      'new'


  onChange: (e) =>
    @setState message: e.target.value


  post: =>
    return @props.close?() if @mode() == 'edit' && @state.message == @props.message

    @setState posting: true

    data = comment: message: @state.message

    switch @mode()
      when 'reply', 'new'
        url = laroute.route 'comments.store'
        method = 'POST'
        data.comment.commentable_type = @props.commentableType
        data.comment.commentable_id = @props.commentableId
        data.comment.parent_id = @props.parent?.id

        onDone = (data) =>
          @setState message: ''
          $.publish 'comments:new', data
      when 'edit'
        url = laroute.route 'comments.update', comment: @props.id
        method = 'PUT'

        onDone = (data) ->
          $.publish 'comment:updated', data

    @xhr = $.ajax url, {method, data}
    .always =>
      @setState posting: false
    .done (data) =>
      onDone(data)
      @props.onPosted?(@mode())
      @props.close?()
    .fail (xhr, status) =>
      osu.ajaxError(xhr, status)
