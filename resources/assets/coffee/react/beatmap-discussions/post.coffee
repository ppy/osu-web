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

import { MessageLengthCounter } from './message-length-counter'
import { UserCard } from './user-card'
import mapperGroup from 'beatmap-discussions/mapper-group'
import { ReviewPost } from 'beatmap-discussions/review-post'
import { BigButton } from 'big-button'
import ClickToCopy from 'click-to-copy'
import * as React from 'react'
import { a, button, div, span } from 'react-dom-factories'
import { ReportReportable } from 'report-reportable'

el = React.createElement

bn = 'beatmap-discussion-post'

export class Post extends React.PureComponent
  constructor: (props) ->
    super props

    @textarea = React.createRef()
    @throttledUpdatePost = _.throttle @updatePost, 1000
    @handleKeyDown = InputHandler.textarea @handleKeyDownCallback
    @xhr = {}
    @cache = {}

    @state =
      editing: false
      posting: false
      message: @props.post.message


  componentDidMount: =>
    osu.pageChange()


  componentWillUpdate: =>
    @cache = {}


  componentDidUpdate: =>
    osu.pageChange()


  componentWillUnmount: =>
    @throttledUpdatePost.cancel()

    for own _id, xhr of @xhr
      xhr?.abort()


  render: =>
    topClasses = "#{bn} #{bn}--#{@props.type}"
    if @state.editing
      topClasses += " #{bn}--editing"
    topClasses += " #{bn}--deleted" if @props.post.deleted_at?
    topClasses += " #{bn}--unread" if !@props.read

    userBadge = if @isOwner() then mapperGroup else @props.user.group_badge

    div
      className: topClasses
      key: "#{@props.type}-#{@props.post.id}"
      onClick: =>
        $.publish 'beatmapDiscussionPost:markRead', id: @props.post.id

      div
        className: "#{bn}__content"
        if (!@props.hideUserCard)
          el UserCard,
            user: @props.user
            badge: userBadge
        @messageViewer()
        @messageEditor()


  editCancel: =>
    @setState
      editing: false
      message: @props.post.message


  editStart: =>
    @textarea.current?.style.minHeight = "#{@messageBody.getBoundingClientRect().height + 50}px"

    @setState editing: true, =>
      @textarea.current?.focus()

  handleKeyDownCallback: (type, event) =>
    switch type
      when InputHandler.SUBMIT
        @throttledUpdatePost()


  isOwner: =>
    @props.post.user_id == @props.beatmapset.user_id


  messageEditor: =>
    return if !@props.canBeEdited

    canPost = !@state.posting && @validPost()

    div className: "#{bn}__message-container #{'hidden' if !@state.editing}",
      el TextareaAutosize,
        disabled: @state.posting
        className: "#{bn}__message #{bn}__message--editor"
        onChange: @setMessage
        onKeyDown: @handleKeyDown
        value: @state.message
        ref: @textarea
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
        ['beatmap-discussion-posts', 'beatmap_discussion_post', @props.post]
      else
        ['beatmap-discussions', 'beatmap_discussion', @props.discussion]

    div className: "#{bn}__message-container #{'hidden' if @state.editing}",
      if @props.discussion.message_type == 'review' && @props.type == 'discussion'
        div
          className: "#{bn}__message"
          ref: (el) => @messageBody = el
          el ReviewPost,
            discussions: @context.discussions
            message: @props.post.message
      else
        div
          className: "#{bn}__message"
          ref: (el) => @messageBody = el
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
                delete_time: osu.timeago @props.post.deleted_at

        if @props.post.updated_at != @props.post.created_at && @props.lastEditor?.id
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
          if @props.type == 'discussion'
            span
              className: "#{bn}__action #{bn}__action--button"
              el ClickToCopy,
                value: BeatmapDiscussionHelper.url discussion: @props.discussion
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
                href: laroute.route('beatmap-discussions.deny-kudosu', beatmap_discussion: @props.discussion.id)
                'data-remote': true
                'data-method': 'POST'
                'data-confirm': osu.trans('common.confirmation')
                osu.trans('beatmaps.discussions.deny_kudosu')
            else if @props.discussion.kudosu_denied
              a
                className: "js-beatmapset-discussion-update #{bn}__action #{bn}__action--button"
                href: laroute.route('beatmap-discussions.allow-kudosu', beatmap_discussion: @props.discussion.id)
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
    @setState message: e.target.value


  updatePost: =>
    if @state.message == @props.post.message
      @setState editing: false
      return

    @setState posting: true

    @xhr.updatePost?.abort()
    @xhr.updatePost = $.ajax laroute.route('beatmap-discussion-posts.update', beatmap_discussion_post: @props.post.id),
      method: 'PUT'
      data:
        beatmap_discussion_post:
          message: @state.message

    .done (data) =>
      @setState editing: false
      $.publish 'beatmapsetDiscussions:update', beatmapset: data

    .fail osu.ajaxError

    .always => @setState posting: false


  validPost: =>
    BeatmapDiscussionHelper.validMessageLength(@state.message, @isTimeline())
