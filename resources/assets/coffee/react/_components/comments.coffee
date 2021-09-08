# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Comment } from 'comment'
import { CommentEditor } from 'comment-editor'
import { CommentShowMore } from 'comment-show-more'
import { CommentsSort } from 'comments-sort'
import DeletedCommentsCount from 'deleted-comments-count'
import { Observer } from 'mobx-react'
import core from 'osu-core-singleton'
import * as React from 'react'
import { button, div, h2, span } from 'react-dom-factories'
import { Spinner } from 'spinner'
import { classWithModifiers } from 'utils/css'

el = React.createElement

store = core.dataStore.commentStore
uiState = core.dataStore.uiState

export class Comments extends React.PureComponent
  render: =>
    el Observer, null, () =>
      # TODO: comments should be passed in as props?
      comments = uiState.comments.topLevelCommentIds.map (id) -> store.comments.get(id)
      pinnedComments = uiState.comments.pinnedCommentIds.map (id) -> store.comments.get(id)

      div className: classWithModifiers('comments', @props.modifiers),
        div className: 'u-has-anchor u-has-anchor--no-event',
          div(id: 'comments')
        h2 className: 'comments__title',
          osu.trans('comments.title')
          span className: 'comments__count', osu.formatNumber(uiState.comments.total)

        if pinnedComments.length > 0
          div className: "comments__items comments__items--pinned",
            @renderComments pinnedComments, true

        div className: 'comments__new',
          el CommentEditor,
            commentableType: @props.commentableType
            commentableId: @props.commentableId
            focus: false
            modifiers: @props.modifiers

        div className: 'comments__items comments__items--toolbar',
          el CommentsSort,
            modifiers: @props.modifiers
          div className: classWithModifiers('sort', @props.modifiers),
            div className: 'sort__items',
              @renderFollowToggle()
              @renderShowDeletedToggle()

        if comments.length > 0
          div className: "comments__items #{if uiState.comments.loadingSort? then 'comments__items--loading' else ''}",
            @renderComments comments, false

            el DeletedCommentsCount, { comments, modifiers: ['top'] }

            el CommentShowMore,
              commentableType: @props.commentableType
              commentableId: @props.commentableId
              comments: comments
              total: uiState.comments.topLevelCount
              sort: uiState.comments.currentSort
              modifiers: _.concat 'top', @props.modifiers
        else
          div
            className: 'comments__items comments__items--empty'
            osu.trans('comments.empty')


  renderComment: (comment, pinned = false) =>
    return null if comment.isDeleted && !core.userPreferences.get('comments_show_deleted')

    el Comment,
      key: comment.id
      comment: comment
      depth: 0
      modifiers: @props.modifiers
      expandReplies: if pinned then false else null


  renderComments: (comments, pinned) =>
    @renderComment(comment, pinned) for comment in comments when comment.pinned == pinned


  renderShowDeletedToggle: =>
    button
      type: 'button'
      className: 'sort__item sort__item--button'
      onClick: @toggleShowDeleted
      span className: 'sort__item-icon',
        span className: if core.userPreferences.get('comments_show_deleted') then 'fas fa-check-square' else 'far fa-square'
      osu.trans('common.buttons.show_deleted')


  renderFollowToggle: =>
    if uiState.comments.userFollow
      icon = 'fas fa-eye-slash'
      label = osu.trans('common.buttons.watch.to_0')
    else
      icon = 'fas fa-eye'
      label = osu.trans('common.buttons.watch.to_1')

    iconEl =
      if @props.loadingFollow
        el Spinner, modifiers: ['center-inline']
      else
        span className: icon

    button
      type: 'button'
      className: 'sort__item sort__item--button'
      onClick: @toggleFollow
      disabled: @props.loadingFollow
      span className: 'sort__item-icon', iconEl
      label


  toggleShowDeleted: ->
    core.userPreferences.set('comments_show_deleted', !core.userPreferences.get('comments_show_deleted'))


  toggleFollow: ->
    $.publish 'comments:toggle-follow'
