# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { NewReply } from './new-reply'
import { Post } from './post'
import { SystemPost } from './system-post'
import { UserCard } from './user-card'
import guestGroup from 'beatmap-discussions/guest-group'
import mapperGroup from 'beatmap-discussions/mapper-group'
import * as React from 'react'
import { renderToStaticMarkup } from 'react-dom/server'
import { button, div, i, span, a } from 'react-dom-factories'
import UserAvatar from 'user-avatar'
import { classWithModifiers } from 'utils/css'

el = React.createElement

bn = 'beatmap-discussion'

VoterList = ({type, discussion, users}) =>
  div
    className: 'user-list-popup user-list-popup--blank'
    if discussion.votes[type] < 1
      osu.trans "beatmaps.discussions.votes.none.#{type}"
    else
      el React.Fragment, null,
        div className: 'user-list-popup__title',
          osu.trans("beatmaps.discussions.votes.latest.#{type}")
          ':'
        discussion.votes['voters'][type].map (userId) =>
          a
            href: laroute.route('users.show', user: userId)
            className: 'js-usercard user-list-popup__user'
            key: userId
            'data-user-id': userId
            el UserAvatar, user: users[userId] ? [], modifiers: ['full']
        if discussion.votes[type] > discussion.votes['voters'][type].length
          div className: 'user-list-popup__remainder-count',
            osu.transChoice 'common.count.plus_others', discussion.votes[type] - discussion.votes['voters'][type].length


export class Discussion extends React.PureComponent
  constructor: (props) ->
    super props

    @eventId = "beatmap-discussion-entry-#{@props.discussion.id}"
    @tooltips = {}


  componentWillUnmount: =>
    @voteXhr?.abort()


  componentDidUpdate: =>
    for own type, tooltip of @tooltips
      @refreshTooltip(tooltip.qtip('api'), type)


  render: =>
    return null if !@isVisible(@props.discussion)
    return null if !@props.discussion.starting_post && (!@props.discussion.posts || @props.discussion.posts.length == 0)

    lineClasses = classWithModifiers "#{bn}__line",
      resolved: @props.discussion.resolved

    lastResolvedState = false
    @_resolvedSystemPostId = null

    firstPost = @props.discussion.starting_post || @props.discussion.posts[0]

    topClasses = classWithModifiers bn,
      'horizontal-desktop': @props.discussion.message_type != 'review'
      deleted: @props.discussion.deleted_at?
      highlighted: @props.highlighted
      preview: @props.preview
      review: @props.discussion.message_type == 'review'
      timeline: @props.discussion.timestamp?
      unread: !@isRead(firstPost)
    topClasses += ' js-beatmap-discussion-jump'

    user = @props.users[@props.discussion.user_id] ? @props.users[null]
    group =
      if user.id == @props.beatmapset.user_id
        mapperGroup
      else if @props.discussion.beatmap_id? && user.id == @props.currentBeatmap.user_id
        guestGroup
      else
        user.groups?[0]

    div
      className: topClasses
      'data-id': @props.discussion.id
      onClick: @emitSetHighlight

      div className: "#{bn}__timestamp hidden-xs",
        @timestamp()

      div className: "#{bn}__discussion",
        div
          className: "#{bn}__top"
          style: osu.groupColour(group)
          div className: "#{bn}__top-user",
            el UserCard,
              user: user
              group: group
              hideStripe: true
          div className: "#{bn}__top-message",
            @post firstPost, 'discussion', true
          div className: "#{bn}__top-actions",
            @postButtons() if !@props.preview
        @postFooter() if !@props.preview
        div className: lineClasses

  postButtons: =>
    div className: "#{bn}__actions",
      if @props.parentDiscussion?
        a
          href: BeatmapDiscussionHelper.url({discussion: @props.parentDiscussion})
          title: osu.trans('beatmap_discussions.review.go_to_parent')
          className: "#{bn}__link-to-parent js-beatmap-discussion--jump",
          i className: 'fas fa-tasks'

      ['up', 'down'].map (type) =>
        div
          key: type
          'data-type': type
          className: "#{bn}__action"
          onMouseOver: @showVoters
          onTouchStart: @showVoters
          @displayVote type

      button
        className: "#{bn}__action #{bn}__action--with-line"
        onClick: @toggleCollapse
        div
          className: "beatmap-discussion-expand #{'beatmap-discussion-expand--expanded' if !@props.collapsed}"
          i className: 'fas fa-chevron-down'


  postFooter: =>
    div
      className: "#{bn}__expanded #{'hidden' if @props.collapsed}"
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
    user = @props.users[@props.discussion.user_id] ? @props.users[null]
    disabled = @isOwner() || user.is_bot || (type == 'down' && !@canDownvote()) || !@canBeRepliedTo()

    button
      className: topClasses
      'data-score': score
      disabled: disabled
      onClick: @doVote
      i className: "fas fa-#{icon}"
      span className: "#{vbn}__count",
        @props.discussion.votes[type]


  getTooltipContent: (type) =>
    renderToStaticMarkup el(VoterList, type: type, discussion: @props.discussion, users: @props.users)


  refreshTooltip: (api, type) =>
    api?.set('content.text', @getTooltipContent(type))


  showVoters: (event) =>
    target = event.currentTarget

    return if target._tooltip

    target._tooltip = true

    type = target.getAttribute('data-type')

    @tooltips[type] =
      $(target).qtip
        style:
          classes: 'user-list-popup'
          def: false
          tip: false
        content:
          text: @getTooltipContent(type)
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

    @voteXhr = $.ajax laroute.route('beatmapsets.discussions.vote', discussion: @props.discussion.id),
      method: 'PUT',
      data:
        beatmap_discussion_vote:
          score: e.currentTarget.dataset.score

    .done (data) =>
      $.publish 'beatmapsetDiscussions:update', beatmapset: data

    .fail osu.ajaxError

    .always LoadingOverlay.hide


  emitSetHighlight: =>
    $.publish 'beatmapset-discussions:highlight', discussionId: @props.discussion.id


  isOwner: (object = @props.discussion) =>
    @props.currentUser.id? && object.user_id == @props.currentUser.id


  isRead: (post) =>
    @props.readPostIds?.has(post.id) || @isOwner(post) || @props.preview


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
      read: @isRead(post)
      users: @props.users
      user: @props.users[post.user_id] ? @props.users[null]
      lastEditor: @props.users[post.last_editor_id] ? @props.users[null] if post.last_editor_id?
      canBeEdited: @props.currentUser.is_admin || canBeEdited
      canBeDeleted: canBeDeleted
      canBeRestored: canModeratePosts
      currentUser: @props.currentUser
      hideUserCard: hideUserCard


  resolvedSystemPostId: =>
    if !@_resolvedSystemPostId?
      systemPost = _.findLast(@props.discussion.posts, (post) -> post? && post.system && post.message.type == 'resolved')
      @_resolvedSystemPostId = systemPost?.id ? -1

    return @_resolvedSystemPostId


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


  toggleCollapse: =>
    $.publish 'beatmapset-discussions:collapse', discussionId: @props.discussion.id
