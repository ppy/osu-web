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

import { NewReply } from './new-reply'
import { Post } from './post'
import { SystemPost } from './system-post'
import { UserCard } from './user-card'
import mapperGroup from 'beatmap-discussions/mapper-group'
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
    topClasses += " #{bn}--review" if @props.discussion.message_type == 'review'

    lineClasses = "#{bn}__line"
    lineClasses += " #{bn}__line--resolved" if @props.discussion.resolved

    lastResolvedState = false
    @_resolvedSystemPostId = null

    firstPost = @props.discussion.starting_post || @props.discussion.posts[0]

    user = @props.users[@props.discussion.user_id]
    badge = if user.id == @props.beatmapset.user_id then mapperGroup else user.group_badge

    topClasses += " #{bn}--unread" unless _.includes(@props.readPostIds, firstPost.id) || @isOwner(firstPost) || @props.preview

    div
      className: topClasses
      'data-id': @props.discussion.id
      onClick: @emitSetHighlight

      div className: "#{bn}__timestamp hidden-xs",
        @timestamp()

      div className: "#{bn}__compact",
        div className: "#{bn}__discussion",
          div
            className: "#{bn}__top"
            style:
              color: osu.groupColour(badge)
            div className: "#{bn}__discussion-header",
              el UserCard,
                user: user
                badge: badge
                hideStripe: true
            @postButtons() if !@props.preview
          div className: "#{bn}__review-wrapper",
            @post firstPost, 'discussion', true
          @postFooter() if !@props.preview
          div className: lineClasses
      div className: "#{bn}__full",
        div className: "#{bn}__discussion",
          div className: "#{bn}__top",
            @post firstPost, 'discussion'
            @postButtons() if !@props.preview
          @postFooter() if !@props.preview
          div className: lineClasses

  postButtons: =>
    div className: "#{bn}__actions-container",
      div className: "#{bn}__actions",
        if @props.parentDiscussion?
          a
            href: BeatmapDiscussionHelper.url({discussion: @props.parentDiscussion})
            title: osu.trans('beatmap_discussions.review.go_to_parent')
            className: "#{bn}__link-to-parent",
            i className: 'fas fa-tasks'

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


  postFooter: =>
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
    @props.currentUser.is_admin || @props.currentUser.is_moderator || @props.currentUser.is_bng


  canBeRepliedTo: =>
    (!@props.beatmapset.discussion_locked || BeatmapDiscussionHelper.canModeratePosts(@props.currentUser)) &&
    (!@props.discussion.beatmap_id? || !@props.currentBeatmap.deleted_at?)


  post: (post, type, hideUserCard) =>
    return if !post.id?

    elementName = if post.system then SystemPost else Post

    canModeratePosts = BeatmapDiscussionHelper.canModeratePosts(@props.currentUser)
    canBeEdited = @isOwner(post) && post.id > @resolvedSystemPostId() && !@props.beatmapset.discussion_locked
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
      hideUserCard: hideUserCard


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
