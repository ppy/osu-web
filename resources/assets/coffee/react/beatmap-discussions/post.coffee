# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { MessageLengthCounter } from './message-length-counter'
import { UserCard } from './user-card'
import { ReviewPost } from 'beatmap-discussions/review-post'
import { BigButton } from 'big-button'
import ClickToCopy from 'click-to-copy'
import * as React from 'react'
import TextareaAutosize from 'react-autosize-textarea'
import { a, button, div, span } from 'react-dom-factories'
import { ReportReportable } from 'report-reportable'
import Editor from 'beatmap-discussions/editor'
import { BeatmapsContext } from 'beatmap-discussions/beatmaps-context'
import { DiscussionsContext } from 'beatmap-discussions/discussions-context'
import { badgeGroup } from 'utils/beatmapset-discussion-helper'
import { classWithModifiers } from 'utils/css'

el = React.createElement

bn = 'beatmap-discussion-post'

export class Post extends React.PureComponent
  constructor: (props) ->
    super props

    @textareaRef = React.createRef()
    @messageBodyRef = React.createRef()
    @throttledUpdatePost = _.throttle @updatePost, 1000
    @handleKeyDown = InputHandler.textarea @handleKeyDownCallback
    @xhr = {}
    @reviewEditor = React.createRef()

    @state =
      canSave: true
      editing: false
      editorMinHeight: '0'
      posting: false
      message: null


  componentWillUnmount: =>
    @throttledUpdatePost.cancel()

    for own _id, xhr of @xhr
      xhr?.abort()


  render: =>
    topClasses = classWithModifiers bn,
      "#{@props.type}": true
      deleted: @props.post.deleted_at?
      editing: @state.editing
      unread: !@props.read && @props.type != 'discussion'

    topClasses += ' js-beatmap-discussion-jump'

    div
      className: topClasses
      'data-post-id': @props.post.id
      key: "#{@props.type}-#{@props.post.id}"
      onClick: =>
        $.publish 'beatmapDiscussionPost:markRead', id: @props.post.id

      div
        className: "#{bn}__content"
        if (@props.type == 'reply')
          el UserCard,
            user: @props.user
            group: badgeGroup
              beatmapset: @props.beatmapset
              currentBeatmap: @props.beatmap
              discussion: @props.discussion
              user: @props.user
        if @state.editing
          @messageEditor()
        else
          @messageViewer()


  editCancel: =>
    @setState editing: false


  editStart: =>
    if @messageBodyRef.current?
      editorMinHeight = "#{@messageBodyRef.current.getBoundingClientRect().height + 50}px"

    @setState
      editing: true
      editorMinHeight: editorMinHeight ? '0'
      message: @props.post.message
      => @textareaRef.current?.focus()



  handleKeyDownCallback: (type, event) =>
    switch type
      when InputHandler.SUBMIT
        @throttledUpdatePost()


  isOwner: =>
    @props.post.user_id == @props.beatmapset.user_id


  messageEditor: =>
    return if !@props.canBeEdited

    canPost = !@state.posting && @state.canSave

    div className: "#{bn}__message-container",
      if @props.discussion.message_type == 'review' && @props.type == 'discussion'
        el DiscussionsContext.Consumer, null,
          (discussions) =>
            el BeatmapsContext.Consumer, null,
              (beatmaps) =>
                el Editor,
                  beatmapset: @props.beatmapset
                  beatmaps: beatmaps
                  document: @props.post.message
                  discussion: @props.discussion
                  discussions: discussions
                  editMode: true
                  editing: @state.editing
                  ref: @reviewEditor
                  onChange: @updateCanSave
      else
        el React.Fragment, null,
          el TextareaAutosize,
            style: minHeight: @state.editorMinHeight
            disabled: @state.posting
            className: "#{bn}__message #{bn}__message--editor"
            onChange: @setMessage
            onKeyDown: @handleKeyDown
            value: @state.message
            ref: @textareaRef
          el MessageLengthCounter, message: @state.message, isTimeline: @isTimeline()

      div className: "#{bn}__actions",
        div className: "#{bn}__actions-group"

        div className: "#{bn}__actions-group",
          div className: "#{bn}__action",
            el BigButton,
              text: osu.trans 'common.buttons.cancel'
              props:
                onClick: @editCancel
                disabled: @state.posting

          div className: "#{bn}__action",
            el BigButton,
              text: osu.trans 'common.buttons.save'
              props:
                onClick: @throttledUpdatePost
                disabled: !canPost


  messageViewer: =>
    [controller, key, deleteModel] =
      if @props.type == 'reply'
        ['beatmapsets.discussions.posts', 'post', @props.post]
      else
        ['beatmapsets.discussions', 'discussion', @props.discussion]

    div className: "#{bn}__message-container",
      if @props.discussion.message_type == 'review' && @props.type == 'discussion'
        div
          className: "#{bn}__message"
          el ReviewPost,
            discussions: @context.discussions
            message: @props.post.message
      else
        div
          className: "#{bn}__message"
          ref: @messageBodyRef
          dangerouslySetInnerHTML:
            __html: BeatmapDiscussionHelper.format @props.post.message

      div className: "#{bn}__info-container",
        span
          className: "#{bn}__info"
          dangerouslySetInnerHTML:
            __html: osu.timeago(@props.post.created_at)

        if deleteModel.deleted_at?
          span
            className: "#{bn}__info #{bn}__info--edited"
            dangerouslySetInnerHTML:
              __html: osu.trans 'beatmaps.discussions.deleted',
                editor: osu.link laroute.route('users.show', user: deleteModel.deleted_by_id),
                  @props.users[deleteModel.deleted_by_id]?.username
                  classNames: ["#{bn}__info-user"]
                delete_time: osu.timeago deleteModel.deleted_at

        if @props.post.updated_at != @props.post.created_at && @props.lastEditor?
          span
            className: "#{bn}__info #{bn}__info--edited"
            dangerouslySetInnerHTML:
              __html: osu.trans 'beatmaps.discussions.edited',
                editor: osu.link laroute.route('users.show', user: @props.lastEditor.id),
                  @props.lastEditor.username
                  classNames: ["#{bn}__info-user"]
                update_time: osu.timeago @props.post.updated_at

        if @props.type == 'discussion' && @props.discussion.kudosu_denied
          span
            className: "#{bn}__info #{bn}__info--edited"
            osu.trans('beatmaps.discussions.kudosu_denied')

      div
        className: "#{bn}__actions"
        div
          className: "#{bn}__actions-group"
          span
            className: "#{bn}__action #{bn}__action--button"
            el ClickToCopy,
              value: BeatmapDiscussionHelper.url discussion: @props.discussion, post: (@props.post if @props.type == 'reply')
              label: osu.trans 'common.buttons.permalink'
              valueAsUrl: true

          if @props.canBeEdited
            button
              className: "#{bn}__action #{bn}__action--button"
              onClick: @editStart
              osu.trans('beatmaps.discussions.edit')

          if !deleteModel.deleted_at? && @props.canBeDeleted
            a
              className: "js-beatmapset-discussion-update #{bn}__action #{bn}__action--button"
              href: laroute.route("#{controller}.destroy", "#{key}": deleteModel.id)
              'data-remote': true
              'data-method': 'DELETE'
              'data-confirm': osu.trans('common.confirmation')
              osu.trans('beatmaps.discussions.delete')

          if deleteModel.deleted_at? && @props.canBeRestored
            a
              className: "js-beatmapset-discussion-update #{bn}__action #{bn}__action--button"
              href: laroute.route("#{controller}.restore", "#{key}": deleteModel.id)
              'data-remote': true
              'data-method': 'POST'
              'data-confirm': osu.trans('common.confirmation')
              osu.trans('beatmaps.discussions.restore')

          if @props.type == 'discussion' && @props.discussion.current_user_attributes?.can_moderate_kudosu
            if @props.discussion.can_grant_kudosu
              a
                className: "js-beatmapset-discussion-update #{bn}__action #{bn}__action--button"
                href: laroute.route('beatmapsets.discussions.deny-kudosu', discussion: @props.discussion.id)
                'data-remote': true
                'data-method': 'POST'
                'data-confirm': osu.trans('common.confirmation')
                osu.trans('beatmaps.discussions.deny_kudosu')
            else if @props.discussion.kudosu_denied
              a
                className: "js-beatmapset-discussion-update #{bn}__action #{bn}__action--button"
                href: laroute.route('beatmapsets.discussions.allow-kudosu', discussion: @props.discussion.id)
                'data-remote': true
                'data-method': 'POST'
                'data-confirm': osu.trans('common.confirmation')
                osu.trans('beatmaps.discussions.allow_kudosu')

          if @canReport()
            el ReportReportable,
              className: "#{bn}__action #{bn}__action--button"
              reportableId: @props.post.id
              reportableType: 'beatmapset_discussion_post'
              user: @props.user


  canReport: =>
    currentUser.id? && @props.post.user_id != currentUser.id


  isTimeline: =>
    @props.discussion.timestamp?


  setMessage: (e) =>
    @setState message: e.target.value, @updateCanSave


  updateCanSave: =>
    @setState canSave: @validPost()


  updatePost: =>
    messageContent = @state.message

    if @props.discussion.message_type == 'review' && @props.type == 'discussion'
      messageContent = @reviewEditor.current.serialize()

      if _.isEqual(JSON.parse(@props.post.message), JSON.parse(messageContent))
        @setState editing: false
        return

      return if !@reviewEditor.current.showConfirmationIfRequired()

      @setState message: messageContent

    if messageContent == @props.post.message
      @setState editing: false
      return

    @setState posting: true

    @xhr.updatePost?.abort()
    @xhr.updatePost = $.ajax laroute.route('beatmapsets.discussions.posts.update', post: @props.post.id),
      method: 'PUT'
      data:
        beatmap_discussion_post:
          message: messageContent

    .done (data) =>
      @setState editing: false
      $.publish 'beatmapsetDiscussions:update', beatmapset: data

    .fail osu.ajaxError

    .always => @setState posting: false


  validPost: =>
    if @props.discussion.message_type == 'review' && @props.type == 'discussion'
      @reviewEditor.current?.canSave
    else
      BeatmapDiscussionHelper.validMessageLength(@state.message, @isTimeline())
