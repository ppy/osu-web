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

{a, button, div, i, span} = ReactDOMFactories
el = React.createElement

bn = 'beatmap-discussion-post'

class BeatmapDiscussions.Post extends React.PureComponent
  constructor: (props) ->
    super props

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
    clearTimeout @state.permalinkTimer if @state.permalinkTimer?

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
        div
          className: "#{bn}__user-container"
          style:
            color: userColor

          a
            className: "#{bn}__user-link"
            href: laroute.route('users.show', user: @props.user.id)

          div className: "#{bn}__avatar",
            el UserAvatar, user: @props.user, modifiers: ['full-rounded']
          div
            className: "#{bn}__user"
            div
              className: "#{bn}__user-row"
              span
                className: "#{bn}__user-text u-ellipsis-overflow"
                style:
                  color: userColor
                @props.user.username

              if !@props.user.is_bot
                a
                  className: "#{bn}__user-modding-history-link"
                  href: laroute.route('users.modding.index', user: @props.user.id)
                  title: osu.trans('beatmap_discussion_posts.item.modding_history_link')
                  i className: 'fas fa-align-left'

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


  editCancel: =>
    @setState
      editing: false
      message: @props.post.message


  editStart: =>
    @textarea.style.minHeight = "#{@messageBody.getBoundingClientRect().height + 50}px"

    @setState editing: true, =>
      @textarea.focus()

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
        innerRef: (el) => @textarea = el
      el BeatmapDiscussions.MessageLengthCounter, message: @state.message

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
                  @props.users[deleteModel.deleted_by_id].username
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
            a
              href: BeatmapDiscussionHelper.url discussion: @props.discussion
              onClick: @permalink
              rel: 'nofollow'
              className: "#{bn}__action #{bn}__action--button"

              if @state.permalinkTimer?
                osu.trans('common.buttons.permalink_copied')
              else
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

  clearPermalinkClicked: =>
    @setState permalinkTimer: null


  permalink: (e) =>
    e.preventDefault()

    # copy url to clipboard
    clipboard.writeText e.currentTarget.href

    # show feedback
    permalinkTmer = Timeout.set 2000, @clearPermalinkClicked

    @setState permalinkTimer: permalinkTmer


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


  userModerationGroup: =>
    if !@cache.hasOwnProperty('userModerationGroup')
      @cache.userModerationGroup = BeatmapDiscussionHelper.moderationGroup(@props.user)

    @cache.userModerationGroup


  validPost: =>
    BeatmapDiscussionHelper.validMessageLength(@state.message)
