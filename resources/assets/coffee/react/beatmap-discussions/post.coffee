###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

bn = 'beatmap-discussion-post'

class BeatmapDiscussions.Post extends React.PureComponent
  constructor: (props) ->
    super props

    @throttledUpdatePost = _.throttle @updatePost, 1000
    @xhr = {}
    @cache = {}

    @state =
      editing: false
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

    userBadge =
      if @isOwner()
        'owner'
      else
        @userModerationGroup()

    topClasses += " #{bn}--#{userBadge}" if userBadge?
    userColor = @props.user.profile_colour if !@isOwner()

    div
      className: topClasses
      key: "#{@props.type}-#{@props.post.id}"
      onClick: =>
        $.publish 'beatmapDiscussionPost:markRead', id: @props.post.id

      div
        className: "#{bn}__content"
        a
          className: "#{bn}__user-container"
          href: laroute.route('users.show', user: @props.user.id)
          style:
            color: userColor
          div className: "#{bn}__avatar",
            el UserAvatar, user: @props.user, modifiers: ['full-rounded']
          div
            className: "#{bn}__user"
            span
              className: "#{bn}__user-text u-ellipsis-overflow"
              style:
                color: userColor
              @props.user.username

            div
              className: "#{bn}__user-badge"
              style:
                backgroundColor: userColor
                opacity: 0 if !userBadge?
              if userBadge?
                osu.trans("beatmap_discussions.user.#{userBadge}")
              else
                ':' # placeholder, not actually visible

          div
            className: "#{bn}__user-stripe"
            style:
              backgroundColor: userColor

        @messageViewer()
        @messageEditor()


  messageInput: (e) =>
    @setState message: e.target.value


  submitIfEnter: (e) =>
    return if e.keyCode != 13

    e.preventDefault()
    @throttledUpdatePost()


  updatePost: =>
    if @state.message == @props.post.message
      @setState editing: false
      return

    LoadingOverlay.show()

    @xhr.updatePost?.abort()
    @xhr.updatePost = $.ajax laroute.route('beatmap-discussion-posts.update', beatmap_discussion_post: @props.post.id),
      method: 'PUT'
      data:
        beatmap_discussion_post:
          message: @state.message

    .done (data) =>
      @setState editing: false
      $.publish 'beatmapsetDiscussion:update', beatmapsetDiscussion: data.beatmapset_discussion

    .fail osu.ajaxError

    .always LoadingOverlay.hide


  editStart: =>
    @textarea.style.minHeight = "#{@messageBody.getBoundingClientRect().height + 50}px"

    @setState editing: true, =>
      @textarea.focus()


  editEnd: =>
    @setState editing: false


  isOwner: =>
    @props.post.user_id == @props.beatmapset.user_id


  messageViewer: =>
    [controller, key, deleteModel] =
      if @props.type == 'reply'
        ['beatmap-discussion-posts', 'beatmap_discussion_post', @props.post]
      else
        ['beatmap-discussions', 'beatmap_discussion', @props.discussion]

    div className: "#{bn}__message-container #{'hidden' if @state.editing}",
      div
        className: "#{bn}__message"
        ref: (el) => @messageBody = el
        dangerouslySetInnerHTML:
          __html: BeatmapDiscussionHelper.linkTimestamp(osu.linkify(_.escape(@props.post.message)), ["#{bn}__timestamp"])

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
                  @props.users[deleteModel.deleted_by_id].username
                  classNames: ["#{bn}__info-user"]
                delete_time: osu.timeago @props.post.deleted_at

        if @props.post.updated_at != @props.post.created_at && @props.post.updated_at != @props.post.deleted_at && @props.lastEditor?.id
          span
            className: "#{bn}__info #{bn}__info--edited"
            dangerouslySetInnerHTML:
              __html: osu.trans 'beatmaps.discussions.edited',
                editor: osu.link laroute.route('users.show', user: @props.lastEditor.id),
                  @props.lastEditor.username
                  classNames: ["#{bn}__info-user"]
                update_time: osu.timeago @props.post.updated_at

      div
        className: "#{bn}__actions"
        div
          className: "#{bn}__actions-group"
          if @props.type == 'discussion'
            a
              href: BeatmapDiscussionHelper.hash discussionId: @props.discussion.id
              onClick: @permalink
              className: "#{bn}__action #{bn}__action--button"
              osu.trans('common.buttons.permalink')

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

          if @props.type == 'discussion' && @props.currentUser.isAdmin
            if @props.discussion.kudosu_denied
              a
                className: "js-beatmapset-discussion-update #{bn}__action #{bn}__action--button"
                href: laroute.route('beatmap-discussions.allow-kudosu', beatmap_discussion: @props.discussion.id)
                'data-remote': true
                'data-method': 'POST'
                'data-confirm': osu.trans('common.confirmation')
                osu.trans('beatmaps.discussions.allow_kudosu')
            else
              a
                className: "js-beatmapset-discussion-update #{bn}__action #{bn}__action--button"
                href: laroute.route('beatmap-discussions.deny-kudosu', beatmap_discussion: @props.discussion.id)
                'data-remote': true
                'data-method': 'POST'
                'data-confirm': osu.trans('common.confirmation')
                osu.trans('beatmaps.discussions.deny_kudosu')



  messageEditor: =>
    return if !@props.canBeEdited

    div className: "#{bn}__message-container #{'hidden' if !@state.editing}",
      textarea
        ref: (el) => @textarea = el
        className: "#{bn}__message #{bn}__message--editor"
        onChange: @messageInput
        onKeyDown: @submitIfEnter
        value: @state.message

      div className: "#{bn}__actions",
        div className: "#{bn}__actions-group"

        div className: "#{bn}__actions-group",
          div className: "#{bn}__action",
            el BigButton,
              text: osu.trans 'common.buttons.cancel'
              props: onClick: @editEnd

          div className: "#{bn}__action",
            el BigButton,
              text: osu.trans 'common.buttons.save'
              props: onClick: @throttledUpdatePost


  permalink: (e) =>
    e.preventDefault()


  userModerationGroup: =>
    if !@cache.hasOwnProperty('userModerationGroup')
      @cache.userModerationGroup = BeatmapDiscussionHelper.moderationGroup(@props.user)

    @cache.userModerationGroup
