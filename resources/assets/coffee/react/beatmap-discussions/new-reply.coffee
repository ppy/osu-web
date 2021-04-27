# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { MessageLengthCounter } from './message-length-counter'
import { BigButton } from 'big-button'
import core from 'osu-core-singleton'
import * as React from 'react'
import TextareaAutosize from 'react-autosize-textarea'
import { button, div, form, input, label, span, i } from 'react-dom-factories'
import UserAvatar from 'user-avatar'
import { createClickCallback } from 'utils/html'
el = React.createElement

bn = 'beatmap-discussion-post'

export class NewReply extends React.PureComponent
  ACTION_ICONS =
    reply_resolve: 'fas fa-check'
    reply_reopen: 'fas fa-exclamation-circle'
    reply: 'fas fa-reply'

  constructor: (props) ->
    super props

    @box = React.createRef()
    @throttledPost = _.throttle @post, 1000
    @handleKeyDown = InputHandler.textarea @handleKeyDownCallback

    @state =
      editing: false
      message: ''
      posting: null


  componentWillUnmount: =>
    @throttledPost.cancel()
    @postXhr?.abort()


  render: =>
    if @state.editing
      @renderBox()
    else
      @renderPlaceholder()


  renderBox: =>
    div
      className: "#{bn} #{bn}--reply #{bn}--new-reply"

      @renderCancelButton()

      div
        className: "#{bn}__content"
        div className: "#{bn}__avatar",
          el UserAvatar, user: @props.currentUser, modifiers: ['full-rounded']

        div className: "#{bn}__message-container",
          el TextareaAutosize,
            disabled: @state.posting?
            className: "#{bn}__message #{bn}__message--editor"
            value: @state.message
            onChange: @setMessage
            onKeyDown: @handleKeyDown
            placeholder: osu.trans 'beatmaps.discussions.reply_placeholder'
            ref: @box

      div
        className: "#{bn}__footer #{bn}__footer--notice"
        osu.trans 'beatmaps.discussions.reply_notice'
        el MessageLengthCounter, message: @state.message, isTimeline: @isTimeline()

      div
        className: "#{bn}__footer"
        div className: "#{bn}__actions",
          div className: "#{bn}__actions-group",
            if @canResolve() && !@props.discussion.resolved
              @renderReplyButton 'reply_resolve'

            if @canReopen() && @props.discussion.resolved
              @renderReplyButton 'reply_reopen'

            @renderReplyButton 'reply'


  renderCancelButton: =>
    button
      className: "#{bn}__action #{bn}__action--cancel"
      disabled: @state.posting?
      onClick: => @setState editing: false
      i className: 'fas fa-times'


  renderPlaceholder: =>
    [text, icon, disabled] =
      if @props.currentUser.id?
        [osu.trans('beatmap_discussions.reply.open.user'), 'fas fa-reply', @props.currentUser.is_silenced]
      else
        [osu.trans('beatmap_discussions.reply.open.guest'), 'fas fa-sign-in-alt', false]

    div
      className: "#{bn} #{bn}--reply #{bn}--new-reply #{bn}--new-reply-placeholder"
      el BigButton,
        text: text
        icon: icon
        modifiers: ['beatmap-discussion-reply-open']
        props:
          disabled: disabled
          onClick: @editStart


  renderReplyButton: (action) =>
    div className: "#{bn}__action",
      el BigButton,
        text: osu.trans("common.buttons.#{action}")
        icon: ACTION_ICONS[action]
        isBusy: @state.posting == action
        props:
          disabled: !@validPost() || @state.posting?
          onClick: @throttledPost
          'data-action': action


  canReopen: =>
    @props.discussion.can_be_resolved && @props.discussion.current_user_attributes.can_reopen


  canResolve: =>
    @props.discussion.can_be_resolved && @props.discussion.current_user_attributes.can_resolve


  editStart: =>
    return if core.userLogin.showIfGuest(@editStart)

    @setState editing: true, =>
      @box.current?.focus()


  handleKeyDownCallback: (type, event) =>
    switch type
      when InputHandler.CANCEL
        @setState editing: false
      when InputHandler.SUBMIT
        @throttledPost(event)


  isTimeline: =>
    @props.discussion.timestamp?


  post: (event) =>
    return if !@validPost()
    LoadingOverlay.show()

    @postXhr?.abort()

    # in case the event came from input box, do 'reply'.
    action = event.currentTarget.dataset.action ? 'reply'
    @setState posting: action

    resolved = switch action
               when 'reply_resolve' then true
               when 'reply_reopen' then false
               else null

    @postXhr = $.ajax laroute.route('beatmapsets.discussions.posts.store'),
      method: 'POST'
      data:
        beatmap_discussion_id: @props.discussion.id
        beatmap_discussion:
          # Only add resolved flag to beatmap_discussion if there was an
          # explicit change (resolve/reopen).
          if resolved?
            resolved: resolved
          else
            {}
        beatmap_discussion_post:
          message: @state.message

    .done (data) =>
      @setState
        message: ''
        editing: false
      $.publish 'beatmapDiscussionPost:markRead', id: data.beatmap_discussion_post_ids
      $.publish 'beatmapsetDiscussions:update', beatmapset: data.beatmapset

    .fail osu.ajaxError

    .always =>
      LoadingOverlay.hide()
      @setState posting: null


  setMessage: (e) =>
    @setState message: e.target.value


  validPost: =>
    BeatmapDiscussionHelper.validMessageLength(@state.message, @isTimeline())
