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

class @Comment extends React.PureComponent
  MAX_DEPTH = 3

  constructor: (props) ->
    super props

    @state =
      editing: false
      showNewReply: false
      showReplies: !@isDeleted()


  render: =>
    children = @props.commentsByParentId[@props.comment.id] ? []
    user = @userFor(@props.comment)

    repliesClass = 'comment__replies'
    repliesClass += ' comment__replies--indented' if @props.depth < MAX_DEPTH
    repliesClass += ' comment__replies--hidden' if !@state.showReplies

    div
      className: osu.classWithModifiers 'comment', @props.modifiers

      if @props.depth == 0 && @state.showReplies && children.length > 0
        div className: 'comment__line'

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
          div className: 'comment__row',
            if user.id?
              a
                className: 'comment__row-item comment__row-item--username comment__row-item--username-link js-usercard'
                'data-user-id': user.id
                href: laroute.route('users.show', user: user.id)
                user.username
            else
              span
                className: 'comment__row-item comment__row-item--username'
                user.username

            if @props.parent?
              message =
                if @props.parent.deleted_at?
                  osu.trans('comments.deleted')
                else
                  _.truncate $(@props.parent.message_html).text(), length: 100
              div
                className: 'comment__row-item comment__row-item--parent'
                title: message
                span className: 'fas fa-reply'
                ' '
                @userFor(@props.parent).username

            span
              className: 'comment__row-item'
              dangerouslySetInnerHTML: __html: osu.timeago(@props.comment.created_at)
          if @state.editing
            div className: 'comment__editor',
              el CommentEditor,
                id: @props.comment.id
                message: @props.comment.message
                modifiers: @props.modifiers
                close: @closeEdit
          else
            div className: 'comment__content',
              if @isDeleted() && !@props.comment.message_html?
                div className: 'comment__deleted',
                  osu.trans('comments.deleted')

              else
                div
                  className: 'comment__message'
                  dangerouslySetInnerHTML:
                    __html: @props.comment.message_html

          div className: 'comment__row comment__row--footer',
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

            if children.length > 0
              div className: 'comment__row-item',
                button
                  type: 'button'
                  className: 'comment__action'
                  onClick: @toggleReplies
                  "[#{if @state.showReplies then '-' else '+'}] "
                  osu.trans('comments.replies')
                  " (#{children.length.toLocaleString()})"

            if !@isDeleted() && @props.comment.edited_at?
              editor = @props.comment.editor ? deletedUser
              div
                className: 'comment__row-item'
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

      div
        className: repliesClass
        for comment in children
          el Comment,
            key: comment.id
            comment: comment
            commentsByParentId: @props.commentsByParentId
            depth: @props.depth + 1
            parent: @props.comment
            modifiers: @props.modifiers


  canDelete: =>
    @canModerate() || @isOwner()


  canEdit: =>
    @canModerate() || @isOwner()


  canRestore: =>
    @canModerate()


  canModerate: =>
    currentUser.is_admin || currentUser.is_gmt


  isOwner: =>
    @props.comment.user_id? && @props.comment.user_id == currentUser.id


  delete: =>
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


  userFor: (comment) =>
    if comment.user?
      comment.user
    else if comment.legacy_name?
      username: comment.legacy_name
    else
      username: osu.trans('users.deleted')


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
    @setState showReplies: !@state.showReplies
