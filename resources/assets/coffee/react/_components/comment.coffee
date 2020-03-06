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

import ClickToCopy from 'click-to-copy'
import { CommentEditor } from 'comment-editor'
import { CommentShowMore } from 'comment-show-more'
import DeletedCommentsCount from 'deleted-comments-count'
import { Observer } from 'mobx-react'
import core from 'osu-core-singleton'
import * as React from 'react'
import { a, button, div, span, textarea } from 'react-dom-factories'
import { ReportReportable } from 'report-reportable'
import { Spinner } from 'spinner'
import { UserAvatar } from 'user-avatar'

el = React.createElement

deletedUser = username: osu.trans('users.deleted')
commentableMetaStore = core.dataStore.commentableMetaStore
store = core.dataStore.commentStore
userStore = core.dataStore.userStore

uiState = core.dataStore.uiState

export class Comment extends React.PureComponent
  MAX_DEPTH = 6

  makePreviewElement = document.createElement('div')

  makePreview = (comment) ->
    if comment.isDeleted
      osu.trans('comments.deleted')
    else
      makePreviewElement.innerHTML = comment.messageHtml
      _.truncate makePreviewElement.textContent, length: 100


  @defaultProps =
    showReplies: true


  constructor: (props) ->
    super props

    @xhr = {}
    @loadMoreRef = React.createRef()

    if osu.isMobile()
      # There's no indentation on mobile so don't expand by default otherwise it will be confusing.
      expandReplies = false
    else if @props.comment.isDeleted
      expandReplies = false
    else if @props.expandReplies?
      expandReplies = @props.expandReplies
    else
      children = uiState.getOrderedCommentsByParentId(@props.comment.id)
      # Collapse if either no children is loaded or current level doesn't add indentation.
      expandReplies = children?.length > 0 && @props.depth < MAX_DEPTH

    @state =
      postingVote: false
      editing: false
      showNewReply: false
      expandReplies: expandReplies


  componentWillUnmount: =>
    xhr?.abort() for own _name, xhr of @xhr


  render: =>
    el Observer, null, () =>
      @children = uiState.getOrderedCommentsByParentId(@props.comment.id) ? []
      parent = store.comments.get(@props.comment.parentId)
      user = @userFor(@props.comment)

      modifiers = @props.modifiers?[..] ? []
      modifiers.push 'top' if @props.depth == 0

      repliesClass = 'comment__replies'
      repliesClass += ' comment__replies--indented' if @props.depth < MAX_DEPTH
      repliesClass += ' comment__replies--hidden' if !@state.expandReplies

      div
        className: osu.classWithModifiers 'comment', modifiers

        @renderRepliesToggle()
        @renderCommentableMeta()

        div className: "comment__main #{if @props.comment.isDeleted then 'comment__main--deleted' else ''}",
          if @props.comment.canHaveVote
            div className: 'comment__float-container comment__float-container--left hidden-xs',
              @renderVoteButton()

          @renderUserAvatar user

          div className: 'comment__container',
            div className: 'comment__row comment__row--header',
              @renderUsername user

              if @props.comment.pinned
                span
                  className: 'comment__row-item  comment__row-item--pinned'
                  span className: 'fa fa-thumbtack'
                  ' '
                  osu.trans 'comments.pinned'

              if parent?
                span
                  className: 'comment__row-item comment__row-item--parent'
                  @parentLink(parent)

              if @props.comment.isDeleted
                span
                  className: 'comment__row-item comment__row-item--deleted'
                  osu.trans('comments.deleted')

            if @state.editing
              div className: 'comment__editor',
                el CommentEditor,
                  id: @props.comment.id
                  message: @props.comment.message
                  modifiers: @props.modifiers
                  close: @closeEdit
            else if @props.comment.messageHtml?
              div
                className: 'comment__message',
                dangerouslySetInnerHTML:
                  __html: @props.comment.messageHtml

            div className: 'comment__row comment__row--footer',
              if @props.comment.canHaveVote
                div
                  className: 'comment__row-item visible-xs'
                  @renderVoteText()

              div
                className: 'comment__row-item comment__row-item--info'
                dangerouslySetInnerHTML: __html: osu.timeago(@props.comment.createdAt)

              @renderPermalink()
              @renderReplyButton()
              @renderEdit()
              @renderRestore()
              @renderDelete()
              @renderPin()
              @renderReport()
              @renderRepliesText()
              @renderEditedBy()

            @renderReplyBox()

        if @props.showReplies && @props.comment.repliesCount > 0
          div
            className: repliesClass
            @children.map @renderComment

            el DeletedCommentsCount, { comments: @children, showDeleted: uiState.comments.isShowDeleted }

            el CommentShowMore,
              parent: @props.comment
              comments: @children
              total: @props.comment.repliesCount
              modifiers: @props.modifiers
              label: osu.trans('comments.load_replies') if @children.length == 0
              ref: @loadMoreRef


  renderComment: (comment) =>
    comment = store.comments.get(comment.id)
    return null if comment.isDeleted && !uiState.comments.isShowDeleted

    el Comment,
      key: comment.id
      comment: comment
      depth: @props.depth + 1
      parent: @props.comment
      modifiers: @props.modifiers


  renderDelete: =>
    if !@props.comment.isDeleted && @props.comment.canDelete
      div className: 'comment__row-item',
        button
          type: 'button'
          className: 'comment__action'
          onClick: @delete
          osu.trans('common.buttons.delete')


  renderPin: =>
    if @props.comment.canPin
      div className: 'comment__row-item',
        button
          type: 'button'
          className: 'comment__action'
          onClick: @togglePinned
          osu.trans 'common.buttons.' + if @props.comment.pinned then 'unpin' else 'pin'


  renderEdit: =>
    if @props.comment.canEdit
      div className: 'comment__row-item',
        button
          type: 'button'
          className: "comment__action #{if @state.editing then 'comment__action--active' else ''}"
          onClick: @toggleEdit
          osu.trans('common.buttons.edit')


  renderEditedBy: =>
    if !@props.comment.isDeleted && @props.comment.isEdited
      editor = userStore.get(@props.comment.editedById)
      div
        className: 'comment__row-item comment__row-item--info'
        dangerouslySetInnerHTML:
          __html: osu.trans 'comments.edited',
            timeago: osu.timeago(@props.comment.editedAt)
            user:
              if editor.id?
                osu.link(laroute.route('users.show', user: editor.id), editor.username, classNames: ['comment__link'])
              else
                _.escape editor.username


  renderPermalink: =>
    div className: 'comment__row-item',
      span
        className: 'comment__action comment__action--permalink'
        el ClickToCopy,
          value: laroute.route('comments.show', comment: @props.comment.id)
          label: osu.trans 'common.buttons.permalink'
          valueAsUrl: true


  renderRepliesText: =>
    return if @props.comment.repliesCount == 0

    if @props.showReplies
      if !@state.expandReplies && @children.length == 0
        onClick = @loadReplies
        label = osu.trans('comments.load_replies')
      else
        onClick = @toggleReplies
        label = "#{osu.trans('comments.replies')} (#{osu.formatNumber(@props.comment.repliesCount)})"

      label = "[#{if @state.expandReplies then '-' else '+'}] #{label}"

      div className: 'comment__row-item',
        button
          type: 'button'
          className: 'comment__action'
          onClick: onClick
          label
    else
      div className: 'comment__row-item',
        osu.trans('comments.replies')
        ': '
        osu.formatNumber(@props.comment.repliesCount)


  renderRepliesToggle: =>
    if @props.showReplies && @props.depth == 0 && @children.length > 0
      div className: 'comment__float-container comment__float-container--right',
        button
          className: 'comment__top-show-replies'
          type: 'button'
          onClick: @toggleReplies
          span className: "fas #{if @state.expandReplies then 'fa-angle-up' else 'fa-angle-down'}"


  renderReplyBox: =>
    if @state.showNewReply
      div className: 'comment__reply-box',
        el CommentEditor,
          close: @closeNewReply
          modifiers: @props.modifiers
          onPosted: @handleReplyPosted
          parent: @props.comment


  renderReplyButton: =>
    if @props.showReplies && !@props.comment.isDeleted
      div className: 'comment__row-item',
        button
          type: 'button'
          className: "comment__action #{if @state.showNewReply then 'comment__action--active' else ''}"
          onClick: @toggleNewReply
          osu.trans('common.buttons.reply')


  renderReport: =>
    if @props.comment.canReport
      div className: 'comment__row-item',
        el ReportReportable,
          className: 'comment__action'
          reportableId: @props.comment.id
          reportableType: 'comment'
          user: @userFor(@props.comment)


  renderRestore: =>
    if @props.comment.isDeleted && @props.comment.canRestore
      div className: 'comment__row-item',
        button
          type: 'button'
          className: 'comment__action'
          onClick: @restore
          osu.trans('common.buttons.restore')


  renderUserAvatar: (user) =>
    if user.id?
      a
        className: 'comment__avatar js-usercard'
        'data-user-id': user.id
        href: laroute.route('users.show', user: user.id)
        el UserAvatar, user: user, modifiers: ['full-circle']
    else
      span
        className: 'comment__avatar'
        el UserAvatar, user: user, modifiers: ['full-circle']


  renderUsername: (user) =>
    if user.id?
      a
        'data-user-id': user.id
        href: laroute.route('users.show', user: user.id)
        className: 'js-usercard comment__row-item comment__row-item--username comment__row-item--username-link'
        user.username
    else
      span
        className: 'comment__row-item comment__row-item--username'
        user.username


  # mobile vote button
  renderVoteButton: =>
    className = osu.classWithModifiers('comment-vote', @props.modifiers)
    className += ' comment-vote--posting' if @state.postingVote

    if @hasVoted()
      className += ' comment-vote--on'
      hover = null
    else
      className += ' comment-vote--off'
      hover = div className: 'comment-vote__hover', '+1'

    button
      className: className
      type: 'button'
      onClick: @voteToggle
      disabled: @state.postingVote || !@props.comment.canVote
      span className: 'comment-vote__text',
        "+#{osu.formatNumberSuffixed(@props.comment.votesCount, null, maximumFractionDigits: 1)}"
      if @state.postingVote
        span className: 'comment-vote__spinner', el Spinner
      hover


  renderVoteText: =>
    className = 'comment__action'
    className += ' comment__action--active' if @hasVoted()

    button
      className: className
      type: 'button'
      onClick: @voteToggle
      disabled: @state.postingVote
      "+#{osu.formatNumberSuffixed(@props.comment.votesCount, null, maximumFractionDigits: 1)}"


  renderCommentableMeta: =>
    return unless @props.showCommentableMeta
    meta = commentableMetaStore.get(@props.comment.commentableType, @props.comment.commentableId)

    if meta.url
      component = a
      params =
        href: meta.url
        className: 'comment__link'
    else
      component = span
      params = null

    div className: 'comment__commentable-meta',
      if @props.comment.commentableType?
        span className: 'comment__commentable-meta-type',
          span className: 'comment__commentable-meta-icon fas fa-comment'
          ' '
          osu.trans("comments.commentable_name.#{@props.comment.commentableType}")
      component params,
        meta.title


  hasVoted: =>
    store.userVotes.has(@props.comment.id)


  delete: =>
    return unless confirm(osu.trans('common.confirmation'))

    @xhr.delete?.abort()
    @xhr.delete = $.ajax laroute.route('comments.destroy', comment: @props.comment.id),
      method: 'DELETE'
    .done (data) =>
      $.publish 'comment:updated', data
    .fail (xhr, status) =>
      return if status == 'abort'

      osu.ajaxError xhr


  togglePinned: =>
    return unless @props.comment.canPin

    @xhr.pin?.abort()
    @xhr.pin = $.ajax laroute.route('comments.pin', comment: @props.comment.id),
      method: if @props.comment.pinned then 'DELETE' else 'POST'
    .done (data) =>
      $.publish 'comment:updated', data
    .fail (xhr, status) =>
      return if status == 'abort'

      osu.ajaxError xhr


  handleReplyPosted: (type) =>
    @setState expandReplies: true if type == 'reply'


  toggleEdit: =>
    @setState editing: !@state.editing


  closeEdit: =>
    @setState editing: false


  loadReplies: =>
    @loadMoreRef.current?.load()
    @toggleReplies()


  parentLink: (parent) =>
    props = title: makePreview(parent)

    if @props.linkParent
      component = a
      props.href = laroute.route('comments.show', comment: parent.id)
      props.className = 'comment__link'
    else
      component = span

    component props,
      span className: 'fas fa-reply'
      ' '
      @userFor(parent).username


  userFor: (comment) =>
    user = userStore.get(comment.userId)?.toJSON()

    if user?
      user
    else if comment.legacyName?
      username: comment.legacyName
    else
      deletedUser


  restore: =>
    @xhr.restore?.abort()
    @xhr.restore = $.ajax laroute.route('comments.restore', comment: @props.comment.id),
      method: 'POST'
    .done (data) =>
      $.publish 'comment:updated', data
    .fail (xhr, status) =>
      return if status == 'abort'

      osu.ajaxError xhr


  toggleNewReply: =>
    @setState showNewReply: !@state.showNewReply


  voteToggle: (e) =>
    target = e.target

    if !currentUser.id?
      userLogin.show target

      return

    @setState postingVote: true

    if @hasVoted()
      method = 'DELETE'
      storeMethod = 'removeUserVote'
    else
      method = 'POST'
      storeMethod = 'addUserVote'

    @xhr.vote?.abort()
    @xhr.vote = $.ajax laroute.route('comments.vote', comment: @props.comment.id),
      method: method
    .always =>
      @setState postingVote: false
    .done (data) =>
      $.publish 'comment:updated', data
      store[storeMethod](@props.comment)

    .fail (xhr, status) =>
      return if status == 'abort'
      return $(target).trigger('ajax:error', [xhr, status]) if xhr.status == 401

      osu.ajaxError xhr


  closeNewReply: =>
    @setState showNewReply: false


  toggleReplies: =>
    @setState expandReplies: !@state.expandReplies
