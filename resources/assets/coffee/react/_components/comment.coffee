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

{a, button, div, span, textarea} = ReactDOMFactories

el = React.createElement

deletedUser = username: osu.trans('users.deleted')

class @Comment extends React.PureComponent
  MAX_DEPTH = 3

  makePreviewElement = document.createElement('div')

  makePreview = (comment) ->
    if comment.deleted_at?
      osu.trans('comments.deleted')
    else
      makePreviewElement.innerHTML = comment.message_html
      _.truncate makePreviewElement.textContent, length: 100


  @defaultProps =
    showReplies: true


  constructor: (props) ->
    super props

    @state =
      editing: false
      showNewReply: false
      expandReplies: !@isDeleted()


  render: =>
    children = @props.childrenArray ? @props.commentsByParentId?[@props.comment.id] ? []
    user = @userFor(@props.comment)
    parent = @props.comment.parent ? @props.parent

    modifiers = @props.modifiers?[..] ? []
    modifiers.push 'top' if @props.depth == 0

    repliesClass = 'comment__replies'
    repliesClass += ' comment__replies--indented' if @props.depth < MAX_DEPTH
    repliesClass += ' comment__replies--hidden' if !@state.expandReplies

    div
      className: osu.classWithModifiers 'comment', modifiers

      if @props.depth == 0 && children.length > 0
        button
          className: 'comment__top-show-replies'
          type: 'button'
          onClick: @toggleReplies
          span className: "fas #{if @state.expandReplies then 'fa-angle-up' else 'fa-angle-down'}"

      div className: "comment__main #{if @isDeleted() then 'comment__main--deleted' else ''}",
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
        div className: 'comment__container',
          if @props.showCommentableMeta
            div className: 'comment__row comment__row--header',
              span
                className: 'comment__row-item comment__row-item--commentable-meta'
                @commentableMeta()


          div className: 'comment__row comment__row--header',
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

            if parent?
              span
                className: 'comment__row-item comment__row-item--parent'
                @parentLink(parent)

            if @isDeleted()
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
          else if @props.comment.message_html?
            div
              className: 'comment__message',
              dangerouslySetInnerHTML:
                __html: @props.comment.message_html

          div className: 'comment__row comment__row--footer',
            div
              className: 'comment__row-item comment__row-item--info'
              dangerouslySetInnerHTML: __html: osu.timeago(@props.comment.created_at)

            if @canModerate()
              div className: 'comment__row-item',
                a
                  href: laroute.route('comments.show', comment: @props.comment.id)
                  className: 'comment__action comment__action--permalink'
                  osu.trans('common.buttons.permalink')

            if @props.showReplies && !@isDeleted()
              div className: 'comment__row-item',
                button
                  type: 'button'
                  className: "comment__action #{if @state.showNewReply then 'comment__action--active' else ''}"
                  onClick: @toggleNewReply
                  osu.trans('common.buttons.reply')

            if @canEdit()
              div className: 'comment__row-item',
                button
                  type: 'button'
                  className: "comment__action #{if @state.editing then 'comment__action--active' else ''}"
                  onClick: @toggleEdit
                  osu.trans('common.buttons.edit')

            if @isDeleted() && @canRestore()
              div className: 'comment__row-item',
                button
                  type: 'button'
                  className: 'comment__action'
                  onClick: @restore
                  osu.trans('common.buttons.restore')

            if !@isDeleted() && @canDelete()
              div className: 'comment__row-item',
                button
                  type: 'button'
                  className: 'comment__action'
                  onClick: @delete
                  osu.trans('common.buttons.delete')

            if @props.comment.replies_count > 0
              div className: 'comment__row-item',
                if @props.showReplies
                  button
                    type: 'button'
                    className: 'comment__action'
                    onClick: @toggleReplies
                    "[#{if @state.expandReplies then '-' else '+'}] "
                    osu.trans('comments.replies')
                    " (#{@props.comment.replies_count.toLocaleString()})"
                else
                  span null,
                    osu.trans('comments.replies')
                    ': '
                    @props.comment.replies_count.toLocaleString()

            if !@isDeleted() && @props.comment.edited_at?
              editor = @props.usersById[@props.comment.edited_by_id] ? deletedUser
              div
                className: 'comment__row-item comment__row-item--info'
                dangerouslySetInnerHTML:
                  __html: osu.trans 'comments.edited',
                    timeago: osu.timeago(@props.comment.edited_at)
                    user:
                      if editor.id?
                        osu.link(laroute.route('users.show', user: editor.id), editor.username, classNames: ['comment__link'])
                      else
                        _.escape editor.username

          if @state.showNewReply
            div className: 'comment__reply-box',
              el CommentEditor,
                parent: @props.comment
                close: @closeNewReply
                modifiers: @props.modifiers

      if @props.showReplies && @props.comment.replies_count > 0
        div
          className: repliesClass
          if @props.children?
            @props.children
          else
            for comment in children
              el Comment,
                key: comment.id
                comment: comment
                commentsByParentId: @props.commentsByParentId
                usersById: @props.usersById
                depth: @props.depth + 1
                parent: @props.comment
                modifiers: @props.modifiers

          if children.length < @props.comment.replies_count
            lastCommentId = _.last(children)?.id
            el CommentShowMore,
              key: "show-more:#{lastCommentId}"
              parent: @props.comment
              after: lastCommentId
              modifiers: @props.modifiers
              label: osu.trans('comments.show_replies') if children.length == 0


  canDelete: =>
    @canModerate() || @isOwner()


  canEdit: =>
    @canModerate() || (@isOwner() && !@isDeleted())


  canRestore: =>
    @canModerate()


  canModerate: =>
    currentUser.is_admin || currentUser.is_gmt


  commentableMeta: =>
    if @props.comment.commentable_meta.url
      component = a
      params = href: @props.comment.commentable_meta.url
    else
      component = span
      params = null

    component params,
      span className: 'fas fa-comment-alt'
      ' '
      @props.comment.commentable_meta.title


  isOwner: =>
    @props.comment.user_id? && @props.comment.user_id == currentUser.id


  delete: =>
    return unless confirm(osu.trans('common.confirmation'))

    $.ajax laroute.route('comments.destroy', comment: @props.comment.id),
      method: 'DELETE'
    .done (data) =>
      $.publish 'comment:updated', comment: data


  toggleEdit: =>
    @setState editing: !@state.editing


  closeEdit: =>
    @setState editing: false


  isDeleted: =>
    @props.comment.deleted_at?


  parentLink: (parent) =>
    props = title: makePreview(parent)

    if @props.linkParent
      component = a
      props.href = laroute.route('comments.show', comment: parent.id)
    else
      component = span

    component props,
      span className: 'fas fa-reply'
      ' '
      @userFor(parent).username


  userFor: (comment) =>
    user = @props.usersById[comment.user_id]

    if user?
      user
    else if comment.legacy_name?
      username: comment.legacy_name
    else
      deletedUser


  restore: =>
    $.ajax laroute.route('comments.restore', comment: @props.comment.id),
      method: 'POST'
    .done (data) =>
      $.publish 'comment:updated', comment: data


  toggleNewReply: =>
    @setState showNewReply: !@state.showNewReply


  closeNewReply: =>
    @setState showNewReply: false


  toggleReplies: =>
    @setState expandReplies: !@state.expandReplies
