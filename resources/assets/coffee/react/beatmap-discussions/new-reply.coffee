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

{button, div, form, input, label, span, i} = ReactDOMFactories
el = React.createElement

bn = 'beatmap-discussion-post'

class BeatmapDiscussions.NewReply extends React.PureComponent
  ACTION_ICONS =
    reply_resolve: 'fas fa-check'
    reply_reopen: 'fas fa-exclamation-circle'
    reply: 'fas fa-reply'

  constructor: (props) ->
    super props

    @throttledPost = _.throttle @post, 1000
    @handleKeyDown = InputHandler.textarea @handleKeyDownCallback

    @state =
      editing: false
      message: ''
      posting: null


  componentWillUnmount: =>
    @throttledPost.cancel()
    @postXhr?.abort()


  render: =>
    if @state.editing
      @renderBox()
    else
      @renderPlaceholder()


  renderBox: =>
    div
      className: "#{bn} #{bn}--reply #{bn}--new-reply"

      div
        className: "#{bn}__content"
        div className: "#{bn}__avatar",
          el UserAvatar, user: @props.currentUser, modifiers: ['full-rounded']

        @renderCancelButton()

        div className: "#{bn}__message-container",
          el TextareaAutosize,
            disabled: @state.posting?
            className: "#{bn}__message #{bn}__message--editor"
            value: @state.message
            onChange: @setMessage
            onKeyDown: @handleKeyDown
            placeholder: osu.trans 'beatmaps.discussions.reply_placeholder'
            innerRef: (el) => @box = el

      div
        className: "#{bn}__footer #{bn}__footer--notice"
        osu.trans 'beatmaps.discussions.reply_notice'
        el BeatmapDiscussions.MessageLengthCounter, message: @state.message

      div
        className: "#{bn}__footer"
        div className: "#{bn}__actions",
          div className: "#{bn}__actions-group",
            if @canResolve() && !@props.discussion.resolved
              @renderReplyButton 'reply_resolve'

            if @canReopen() && @props.discussion.resolved
              @renderReplyButton 'reply_reopen'

            @renderReplyButton 'reply'


  renderCancelButton: =>
    button
      className: "#{bn}__action #{bn}__action--cancel"
      disabled: @state.posting?
      onClick: => @setState editing: false
      i className: 'fas fa-times'


  renderPlaceholder: =>
    [text, icon] =
      if @props.currentUser.id?
        [osu.trans('beatmap_discussions.reply.open.user'), 'fas fa-reply']
      else
        [osu.trans('beatmap_discussions.reply.open.guest'), 'fas fa-sign-in-alt']

    div
      className: "#{bn} #{bn}--reply #{bn}--new-reply #{bn}--new-reply-placeholder"
      el BigButton,
        text: text
        icon: icon
        modifiers: ['beatmap-discussion-reply-open']
        props:
          onClick: @editStart


  renderReplyButton: (action) =>
    div className: "#{bn}__action",
      el BigButton,
        text: osu.trans("common.buttons.#{action}")
        icon: if @state.posting == action then '_spinner' else ACTION_ICONS[action]
        props:
          disabled: !@validPost() || @state.posting?
          onClick: @throttledPost
          'data-action': action


  canReopen: =>
    @props.discussion.can_be_resolved && @props.discussion.current_user_attributes.can_reopen


  canResolve: =>
    @props.discussion.can_be_resolved && @props.discussion.current_user_attributes.can_resolve


  editStart: =>
    if !@props.currentUser.id?
      userLogin.show()
      return

    @setState editing: true, =>
      @box?.focus()


  handleKeyDownCallback: (type, event) =>
    switch type
      when InputHandler.CANCEL
        @setState editing: false
      when InputHandler.SUBMIT
        @throttledPost(event)


  post: (event) =>
    return if !@validPost()
    LoadingOverlay.show()

    @postXhr?.abort()

    action = event.currentTarget.dataset.action
    @setState posting: action

    resolved = switch action
               when 'reply_resolve' then true
               when 'reply_reopen' then false
               else @props.discussion.resolved

    @postXhr = $.ajax laroute.route('beatmap-discussion-posts.store'),
      method: 'POST'
      data:
        beatmap_discussion_id: @props.discussion.id
        beatmap_discussion:
          resolved: resolved
        beatmap_discussion_post:
          message: @state.message

    .done (data) =>
      @setState
        message: ''
        editing: false
      $.publish 'beatmapDiscussionPost:markRead', id: data.beatmap_discussion_post_ids
      $.publish 'beatmapsetDiscussions:update', beatmapset: data.beatmapset

    .fail osu.ajaxError

    .always =>
      LoadingOverlay.hide()
      @setState posting: null


  setMessage: (e) =>
    @setState message: e.target.value


  validPost: =>
    BeatmapDiscussionHelper.validMessageLength(@state.message)
