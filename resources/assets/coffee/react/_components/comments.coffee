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

import { Comment } from 'comment'
import { CommentEditor } from 'comment-editor'
import { CommentShowMore } from 'comment-show-more'
import { CommentsSort } from 'comments-sort'
import DeletedCommentsCount from 'deleted-comments-count'
import * as React from 'react'
import { button, div, h2, span } from 'react-dom-factories'
import { Spinner } from 'spinner'

el = React.createElement

export class Comments extends React.PureComponent
  render: =>
    @commentsByParentId = _.groupBy(@props.comments, 'parent_id')
    comments = @commentsByParentId[null]

    div className: osu.classWithModifiers('comments', @props.modifiers),
      div className: 'u-has-anchor',
        div(className: 'fragment-target fragment-target--no-event', id: 'comments')
      h2 className: 'comments__title',
        osu.trans('comments.title')
        span className: 'comments__count', osu.formatNumber(@props.total)
      div className: 'comments__new',
        el CommentEditor,
          commentableType: @props.commentableType
          commentableId: @props.commentableId
          focus: false
          modifiers: @props.modifiers
      div className: 'comments__content',
        div className: 'comments__items comments__items--toolbar',
          el CommentsSort,
            loadingSort: @props.loadingSort
            currentSort: @props.currentSort
            modifiers: @props.modifiers
          div className: osu.classWithModifiers('sort', @props.modifiers),
            div className: 'sort__items',
              @renderFollowToggle()
              @renderShowDeletedToggle()
        if comments?
          div className: "comments__items #{if @props.loadingSort? then 'comments__items--loading' else ''}",
            comments.map @renderComment

            el DeletedCommentsCount, { comments, showDeleted: @props.showDeleted, modifiers: ['top'] }

            el CommentShowMore,
              commentableType: @props.commentableType
              commentableId: @props.commentableId
              comments: comments
              total: @props.topLevelCount
              sort: @props.currentSort
              modifiers: _.concat 'top', @props.modifiers
              moreComments: @props.moreComments
        else
          div
            className: 'comments__items comments__items--empty'
            osu.trans('comments.empty')


  renderComment: (comment) =>
    return null if comment.deleted_at? && !@props.showDeleted

    el Comment,
      key: comment.id
      comment: comment
      commentsByParentId: @commentsByParentId
      userVotesByCommentId: @props.userVotesByCommentId
      usersById: @props.usersById
      depth: 0
      currentSort: @props.currentSort
      modifiers: @props.modifiers
      moreComments: @props.moreComments
      showDeleted: @props.showDeleted


  renderShowDeletedToggle: =>
    button
      type: 'button'
      className: 'sort__item sort__item--button'
      onClick: @toggleShowDeleted
      span className: 'sort__item-icon',
        span className: if @props.showDeleted then 'fas fa-check-square' else 'far fa-square'
      osu.trans('common.buttons.show_deleted')


  renderFollowToggle: =>
    if @props.userFollow
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
    $.publish 'comments:toggle-show-deleted'


  toggleFollow: ->
    $.publish 'comments:toggle-follow'
