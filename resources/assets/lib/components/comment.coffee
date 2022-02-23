# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute'
import { Observer } from 'mobx-react'
import core from 'osu-core-singleton'
import * as React from 'react'
import { a, button, div, span, textarea } from 'react-dom-factories'
import { classWithModifiers } from 'utils/css'
import { estimateMinLines } from 'utils/estimate-min-lines'
import { createClickCallback, formatNumberSuffixed } from 'utils/html'
import ClickToCopy from './click-to-copy'
import { CommentEditor } from './comment-editor'
import { CommentShowMore } from './comment-show-more'
import DeletedCommentsCount from './deleted-comments-count'
import { ReportReportable } from './report-reportable'
import ShowMoreLink from './show-more-link'
import { Spinner } from './spinner'
import StringWithComponent from './string-with-component'
import TimeWithTooltip from './time-with-tooltip'
import UserAvatar from './user-avatar'
import { UserLink } from './user-link'
import { isBlocked } from 'utils/user-helper';

el = React.createElement

deletedUser = username: osu.trans('users.deleted')
commentableMetaStore = core.dataStore.commentableMetaStore
store = core.dataStore.commentStore
userStore = core.dataStore.userStore

uiState = core.dataStore.uiState

export class Comment extends React.PureComponent
  CLIP_LINES = 7
  MAX_DEPTH = 6

  makePreviewElement = document.createElement('div')

  makePreview = (comment) ->
    if comment.isDeleted
      osu.trans('comments.deleted')
    else
      makePreviewElement.innerHTML = comment.messageHtml
      _.truncate makePreviewElement.textContent, length: 100


  constructor: (props) ->
    super props

    @xhr = {}
    @loadMoreRef = React.createRef()

    if osuCore.windowSize.isMobile
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
      clipped: true
      postingVote: false
      editing: false
      showNewReply: false
      expandReplies: expandReplies
      lines: null
      forceShow: false


  componentWillUnmount: =>
    xhr?.abort() for own _name, xhr of @xhr


  componentDidMount: =>
    @setState lines: estimateMinLines(@props.comment.messageHtml ? '')


  componentDidUpdate: (prevProps) =>
    if prevProps.comment.messageHtml != @props.comment.messageHtml
      @setState lines: estimateMinLines(@props.comment.messageHtml ? '')


  render: =>
    el Observer, null, () =>
      @children = uiState.getOrderedCommentsByParentId(@props.comment.id) ? []
      parent = store.comments.get(@props.comment.parentId)
      user = @userFor(@props.comment)
      meta = commentableMetaStore.get(@props.comment.commentableType, @props.comment.commentableId)

      # Only clip if there are at least CLIP_LINES + 2 lines to ensure there are enough contents
      # being clipped instead of just single lone line (or worse no more lines because of rounding up).
      longContent = @state.lines? && @state.lines.count >= CLIP_LINES + 2

      modifiers = @props.modifiers?[..] ? []
      modifiers.push 'top' if @props.depth == 0

      mainModifiers = []
      mainModifiers.push 'deleted' if @props.comment.isDeleted
      mainModifiers.push 'clip' if @state.clipped && longContent

      repliesClass = 'comment__replies'
      repliesClass += ' comment__replies--indented' if @props.depth < MAX_DEPTH
      repliesClass += ' comment__replies--hidden' if !@state.expandReplies

      div
        className: classWithModifiers 'comment', modifiers

        @renderRepliesToggle()
        @renderCommentableMeta(meta)
        @renderToolbar()

        div
          className: classWithModifiers('comment__main', mainModifiers)
          style:
            '--line-height': if @state.lines? then "#{@state.lines.lineHeight}px" else undefined
            '--clip-lines': CLIP_LINES
          if @props.comment.canHaveVote
            div className: 'comment__float-container comment__float-container--left hidden-xs',
              @renderVoteButton()

          @renderUserAvatar user

          div className: 'comment__container',
            div className: 'comment__row comment__row--header',
              @renderUsername user
              @renderOwnerBadge(meta)

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
            else if isBlocked(user) && !@state.forceShow
                el React.Fragment, null,
                  div
                    className: 'comment__message osu-md osu-md--comment'
                    el 'p',
                      className: 'osu-md__paragraph',
                      osu.trans('users.blocks.comment_text')
            else if @props.comment.messageHtml?
              el React.Fragment, null,
                div
                  className: 'comment__message',
                  dangerouslySetInnerHTML:
                    __html: @props.comment.messageHtml
                @renderToggleClipButton() if longContent

            div className: 'comment__row comment__row--footer',
              if @props.comment.canHaveVote
                div
                  className: 'comment__row-item visible-xs'
                  @renderVoteButton(true)

              div
                className: 'comment__row-item comment__row-item--info'
                el TimeWithTooltip, dateTime: @props.comment.createdAt, relative: true

              @renderPermalink()
              @renderReplyButton()
              @renderEdit()
              @renderRestore()
              @renderDelete()
              @renderPin()
              @renderReport()
              @renderEditedBy()
              @renderDeletedBy()
              @renderForceShowButton()
              @renderRepliesText()

            @renderReplyBox()

        if @props.comment.repliesCount > 0
          div
            className: repliesClass
            @children.map @renderComment

            el DeletedCommentsCount, { comments: @children }

            el CommentShowMore,
              parent: @props.comment
              comments: @children
              total: @props.comment.repliesCount
              modifiers: @props.modifiers
              label: osu.trans('comments.load_replies') if @children.length == 0
              ref: @loadMoreRef


  renderComment: (comment) =>
    comment = store.comments.get(comment.id)
    return null if comment.isDeleted && !core.userPreferences.get('comments_show_deleted')

    el Comment,
      key: comment.id
      comment: comment
      depth: @props.depth + 1
      parent: @props.comment
      modifiers: @props.modifiers
      expandReplies: @props.expandReplies


  renderDelete: =>
    if !@props.comment.isDeleted && @props.comment.canDelete
      div className: 'comment__row-item',
        button
          type: 'button'
          className: 'comment__action'
          onClick: @delete
          osu.trans('common.buttons.delete')


  renderDeletedBy: =>
    if @props.comment.isDeleted && @props.comment.canModerate
      div className: 'comment__row-item comment__row-item--info',
        el StringWithComponent,
          mappings:
            timeago:
              el TimeWithTooltip,
                dateTime: @props.comment.deletedAt
                relative: true
            user:
              if @props.comment.deletedById?
                el UserLink, user: (userStore.get(@props.comment.deletedById) ? deletedUser)
              else
                osu.trans('comments.deleted_by_system')
          pattern: osu.trans('comments.deleted_by')


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
        el StringWithComponent,
          mappings:
            timeago: el(TimeWithTooltip, dateTime: @props.comment.editedAt, relative: true)
            user: el UserLink, user: editor
          pattern: osu.trans('comments.edited')


  renderOwnerBadge: (meta) =>
    return null unless meta.owner_id? && @props.comment.userId == meta.owner_id

    div className: 'comment__row-item',
      div className: 'comment__owner-badge', meta.owner_title


  renderPermalink: =>
    div className: 'comment__row-item',
      span
        className: 'comment__action comment__action--permalink'
        el ClickToCopy,
          value: route('comments.show', comment: @props.comment.id)
          label: osu.trans 'common.buttons.permalink'
          valueAsUrl: true


  renderRepliesText: =>
    return if @props.comment.repliesCount == 0

    if !@state.expandReplies && @children.length == 0
      callback = @loadReplies
      label = osu.trans('comments.load_replies')
    else
      callback = @toggleReplies
      label = osu.transChoice('comments.replies_count', @props.comment.repliesCount)

    div className: 'comment__row-item comment__row-item--replies',
      el ShowMoreLink,
        direction: if @state.expandReplies then 'up' else 'down'
        hasMore: true
        label: label
        callback: callback
        modifiers: ['comment-replies']


  renderRepliesToggle: =>
    if @props.depth == 0 && @children.length > 0
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
    if !@props.comment.isDeleted
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


  renderToggleClipButton: =>
    button
      type: 'button'
      className: 'comment__toggle-clip'
      onClick: @toggleClip
      if @state.clipped
        osu.trans('common.buttons.read_more')
      else
        osu.trans('common.buttons.show_less')


  renderUserAvatar: (user) =>
    if isBlocked(user) && !@state.forceShow
      span
        className: 'comment__avatar'
        el UserAvatar, user: { avatar_url: null }, modifiers: ['full-circle']
    else if user.id?
      a
        className: 'comment__avatar js-usercard'
        'data-user-id': user.id
        href: route('users.show', user: user.id)
        el UserAvatar, user: user, modifiers: ['full-circle']
    else
      span
        className: 'comment__avatar'
        el UserAvatar, user: user, modifiers: ['full-circle']


  renderUsername: (user) =>
    if isBlocked(user) && !@state.forceShow
      span
        className: 'comment__row-item'
        osu.trans('users.blocks.blocked_user')
    else if user.id?
      a
        'data-user-id': user.id
        href: route('users.show', user: user.id)
        className: 'js-usercard comment__row-item'
        user.username
    else
      span
        className: 'comment__row-item'
        user.username


  renderVoteButton: (inline = false) =>
    hasVoted = @hasVoted()

    className = classWithModifiers 'comment-vote',
      @props.modifiers
      disabled: !@props.comment.canVote
      inline: inline
      on: hasVoted
      posting: @state.postingVote

    hover = div className: 'comment-vote__hover', '+1' if !inline && !hasVoted

    button
      className: className
      type: 'button'
      onClick: @voteToggle
      disabled: @state.postingVote || !@props.comment.canVote
      span className: 'comment-vote__text',
        "+#{formatNumberSuffixed(@props.comment.votesCount, null, maximumFractionDigits: 1)}"
      if @state.postingVote
        span className: 'comment-vote__spinner', el Spinner
      hover


  renderCommentableMeta: (meta) =>
    return unless @props.showCommentableMeta

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


  renderToolbar: =>
    return unless @props.showToolbar

    div className: 'comment__toolbar',
      div className: 'sort',
        div className: 'sort__items',
          button
            type: 'button'
            className: 'sort__item sort__item--button'
            onClick: @onShowDeletedToggleClick
            span className: 'sort__item-icon',
              span className: if core.userPreferences.get('comments_show_deleted') then 'fas fa-check-square' else 'far fa-square'
            osu.trans('common.buttons.show_deleted')

  renderForceShowButton: =>
    if isBlocked(@userFor(@props.comment))
      div className: 'comment__row-item',
        button
          type: 'button'
          className: 'comment__action'
          onClick: @toggleForceShow
          if !@state.forceShow then osu.trans('users.blocks.show_comment') else osu.trans('users.blocks.hide_comment')

  hasVoted: =>
    store.userVotes.has(@props.comment.id)


  delete: =>
    return unless confirm(osu.trans('common.confirmation'))

    @xhr.delete?.abort()
    @xhr.delete = $.ajax route('comments.destroy', comment: @props.comment.id),
      method: 'DELETE'
    .done (data) =>
      $.publish 'comment:updated', data
    .fail (xhr, status) =>
      return if status == 'abort'

      osu.ajaxError xhr


  togglePinned: =>
    return unless @props.comment.canPin

    @xhr.pin?.abort()
    @xhr.pin = $.ajax route('comments.pin', comment: @props.comment.id),
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


  onShowDeletedToggleClick: ->
    core.userPreferences.set('comments_show_deleted', !core.userPreferences.get('comments_show_deleted'))


  parentLink: (parent) =>
    props = title: makePreview(parent)

    if @props.linkParent
      component = a
      props.href = route('comments.show', comment: parent.id)
      props.className = 'comment__link'
    else
      component = span

    component props,
      span className: 'fas fa-reply'
      ' '
      @userFor(parent).username


  userFor: (comment) =>
    user = userStore.get(comment.userId)?.toJson()

    if user?
      user
    else if comment.legacyName?
      username: comment.legacyName
    else
      deletedUser


  restore: =>
    @xhr.restore?.abort()
    @xhr.restore = $.ajax route('comments.restore', comment: @props.comment.id),
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

    return if core.userLogin.showIfGuest(createClickCallback(target))

    @setState postingVote: true

    if @hasVoted()
      method = 'DELETE'
      storeMethod = 'removeUserVote'
    else
      method = 'POST'
      storeMethod = 'addUserVote'

    @xhr.vote?.abort()
    @xhr.vote = $.ajax route('comments.vote', comment: @props.comment.id),
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


  toggleClip: =>
    @setState clipped: !@state.clipped

  toggleForceShow: =>
    @setState forceShow: !@state.forceShow
