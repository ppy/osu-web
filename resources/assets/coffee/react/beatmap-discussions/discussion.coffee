###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import { NewReply } from './new-reply'
import { Post } from './post'
import { SystemPost } from './system-post'
import * as React from 'react'
import { button, div, i, span, a } from 'react-dom-factories'
import { UserAvatar } from 'user-avatar'

el = React.createElement

bn = 'beatmap-discussion'

export class Discussion extends React.PureComponent
  constructor: (props) ->
    super props

    @eventId = "beatmap-discussion-entry-#{@props.discussion.id}"
    @tooltips = {}

    @state =
      collapsed: false
      highlighted: false


  componentWillMount: =>
    $.subscribe "beatmapDiscussionEntry:collapse.#{@eventId}", @setCollapse
    $.subscribe "beatmapDiscussionEntry:highlight.#{@eventId}", @setHighlight


  componentWillUnmount: =>
    $.unsubscribe ".#{@eventId}"
    @voteXhr?.abort()


  componentDidUpdate: =>
    _.each @tooltips, (tooltip, type) =>
      @refreshTooltip(tooltip.qtip('api'), type)


  render: =>
    return null if !@isVisible(@props.discussion)
    return null if !@props.discussion.starting_post && (!@props.discussion.posts || @props.discussion.posts.length == 0)

    topClasses = "#{bn} js-beatmap-discussion-jump"
    topClasses += " #{bn}--highlighted" if @state.highlighted
    topClasses += " #{bn}--deleted" if @props.discussion.deleted_at?
    topClasses += " #{bn}--timeline" if @props.discussion.timestamp?
    topClasses += " #{bn}--preview" if @props.preview

    lineClasses = "#{bn}__line"
    lineClasses += " #{bn}__line--resolved" if @props.discussion.resolved

    lastResolvedState = false
    @_resolvedSystemPostId = null

    div
      className: topClasses
      'data-id': @props.discussion.id
      onClick: @emitSetHighlight

      div className: "#{bn}__timestamp hidden-xs",
        @timestamp()

      div className: "#{bn}__discussion",
        div className: "#{bn}__top",
          @post @props.discussion.starting_post || @props.discussion.posts[0], 'discussion'

          if !@props.preview
            div className: "#{bn}__actions",
              ['up', 'down'].map (type) =>
                div
                  key: type
                  type: type
                  className: "#{bn}__action"
                  onMouseOver: @showVoters
                  onTouchStart: @showVoters
                  @displayVote type
                  @voterList type

              button
                className: "#{bn}__action #{bn}__action--with-line"
                onClick: @toggleExpand
                div
                  className: "beatmap-discussion-expand #{'beatmap-discussion-expand--expanded' if !@state.collapsed}"
                  i className: 'fas fa-chevron-down'

        if !@props.preview
          div
            className: "#{bn}__expanded #{'hidden' if @state.collapsed}"
            div
              className: "#{bn}__replies"
              for reply in @props.discussion.posts.slice(1)
                continue unless @isVisible(reply)
                if reply.system && reply.message.type == 'resolved'
                  currentResolvedState = reply.message.value
                  continue if lastResolvedState == currentResolvedState
                  lastResolvedState = currentResolvedState

                @post reply, 'reply'

            if @canBeRepliedTo()
              el NewReply,
                currentUser: @props.currentUser
                beatmapset: @props.beatmapset
                currentBeatmap: @props.currentBeatmap
                discussion: @props.discussion

        div className: lineClasses


  displayVote: (type) =>
    vbn = 'beatmap-discussion-vote'

    [baseScore, icon] = switch type
      when 'up' then [1, 'thumbs-up']
      when 'down' then [-1, 'thumbs-down']

    return if !baseScore?

    currentVote = @props.discussion.current_user_attributes?.vote_score

    score = if currentVote == baseScore then 0 else baseScore

    topClasses = "#{vbn} #{vbn}--#{type}"
    topClasses += " #{vbn}--inactive" if score != 0
    disabled = @isOwner() || (type == 'down' && !@canDownvote()) || !@canBeRepliedTo()

    button
      className: topClasses
      'data-score': score
      disabled: disabled
      onClick: @doVote
      i className: "fas fa-#{icon}"
      span className: "#{vbn}__count",
        @props.discussion.votes[type]


  voterList: (type) =>
    div
      className: "user-list-popup user-list-popup__template js-user-list-popup--#{@props.discussion.id}-#{type}"
      style:
        display: 'none'
      if @props.discussion.votes[type] < 1
        osu.trans "beatmaps.discussions.votes.none.#{type}"
      else
        el React.Fragment, null,
          div className: 'user-list-popup__title',
            osu.trans("beatmaps.discussions.votes.latest.#{type}")
            ':'
          @props.discussion.votes['voters'][type].map (userId) =>
            a
              href: laroute.route('users.show', user: userId)
              className: 'js-usercard user-list-popup__user'
              key: userId
              'data-user-id': userId
              el UserAvatar, user: @props.users[userId] ? [], modifiers: ['full']
          if @props.discussion.votes[type] > @props.discussion.votes['voters'][type].length
            div className: 'user-list-popup__remainder-count',
              osu.transChoice 'common.count.plus_others', @props.discussion.votes[type] - @props.discussion.votes['voters'][type].length


  getTooltipContent: (type) =>
    $(".js-user-list-popup--#{@props.discussion.id}-#{type}").html()


  refreshTooltip: (api, type) =>
    return unless api
    api.set('content.text', @getTooltipContent(type))


  showVoters: (event) =>
    target = event.currentTarget

    if @props.favcount < 1 || target._tooltip
      return

    target._tooltip = true

    type = target.getAttribute('type')

    @tooltips[type] =
      $(target).qtip
        style:
          classes: 'user-list-popup'
          def: false
          tip: false
        content:
          text: (event, api) => @getTooltipContent(type)
        position:
          at: 'top center'
          my: 'bottom center'
          viewport: $(window)
        show:
          delay: 100
          ready: true
          solo: true
          effect: -> $(this).fadeTo(110, 1)
        hide:
          fixed: true
          delay: 500
          effect: -> $(this).fadeTo(250, 0)


  doVote: (e) =>
    LoadingOverlay.show()

    @voteXhr?.abort()

    @voteXhr = $.ajax laroute.route('beatmap-discussions.vote', beatmap_discussion: @props.discussion.id),
      method: 'PUT',
      data:
        beatmap_discussion_vote:
          score: e.currentTarget.dataset.score

    .done (data) =>
      $.publish 'beatmapsetDiscussions:update', beatmapset: data

    .fail osu.ajaxError

    .always LoadingOverlay.hide


  emitSetHighlight: =>
    $.publish 'beatmapDiscussionEntry:highlight', id: @props.discussion.id


  isOwner: (object = @props.discussion) =>
    @props.currentUser.id? && object.user_id == @props.currentUser.id


  isVisible: (object) =>
    object? && (@props.showDeleted || !object.deleted_at?)


  canDownvote: =>
    @props.currentUser.is_admin || @props.currentUser.can_moderate || @props.currentUser.is_bng


  canBeRepliedTo: =>
    (!@props.beatmapset.discussion_locked || BeatmapDiscussionHelper.canModeratePosts(@props.currentUser)) &&
    (!@props.discussion.beatmap_id? || !@props.currentBeatmap.deleted_at?)


  post: (post, type) =>
    return if !post.id?

    elementName = if post.system then SystemPost else Post

    canModeratePosts = BeatmapDiscussionHelper.canModeratePosts(@props.currentUser)
    canBeEdited = @isOwner(post) && post.id > @resolvedSystemPostId()
    canBeDeleted =
      if type == 'discussion'
        @props.discussion.current_user_attributes?.can_destroy
      else
        canModeratePosts || canBeEdited

    el elementName,
      key: post.id
      beatmapset: @props.beatmapset
      beatmap: @props.currentBeatmap
      discussion: @props.discussion
      post: post
      type: type
      read: _.includes(@props.readPostIds, post.id) || @isOwner(post) || @props.preview
      users: @props.users
      user: @props.users[post.user_id]
      lastEditor: @props.users[post.last_editor_id]
      canBeEdited: @props.currentUser.is_admin || canBeEdited
      canBeDeleted: canBeDeleted
      canBeRestored: canModeratePosts
      currentUser: @props.currentUser


  resolvedSystemPostId: =>
    if !@_resolvedSystemPostId?
      systemPost = _.findLast(@props.discussion.posts, (post) -> post.system && post.message.type == 'resolved')
      @_resolvedSystemPostId = systemPost?.id ? -1

    return @_resolvedSystemPostId


  setCollapse: (_e, {collapse}) =>
    return unless @props.visible

    newState = collapse == 'collapse'

    return if @state.collapsed == newState

    @setState collapsed: newState


  setHighlight: (_e, {id}) =>
    newState = id == @props.discussion.id

    return if @state.highlighted == newState

    @setState highlighted: newState


  timestamp: =>
    tbn = 'beatmap-discussion-timestamp'

    div className: tbn,
      div(className: "#{tbn}__point") if @props.discussion.timestamp? && @props.isTimelineVisible
      div className: "#{tbn}__icons-container",
        div className: "#{tbn}__icons",
          div className: "#{tbn}__icon",
            span
              className: "beatmap-discussion-message-type beatmap-discussion-message-type--#{_.kebabCase(@props.discussion.message_type)}"
              i className: BeatmapDiscussionHelper.messageType.icon[_.camelCase(@props.discussion.message_type)]

          if @props.discussion.resolved
            div className: "#{tbn}__icon #{tbn}__icon--resolved",
              i className: 'far fa-check-circle'

        div className: "#{tbn}__text",
          BeatmapDiscussionHelper.formatTimestamp @props.discussion.timestamp


  toggleExpand: =>
    @setState collapsed: !@state.collapsed
