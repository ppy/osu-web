###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
{button, div, span} = React.DOM
el = React.createElement

bn = 'beatmap-discussion'

BeatmapDiscussions.Discussion = React.createClass
  # Broken in chrome.
  # Animation is missing when collapsing for the first time.
  # Or it collapses and reexpands itself when highlighted for the first time.
  # mixins: [React.addons.PureRenderMixin]


  render: ->
    return div() if @props.discussion.beatmap_discussion_posts.length == 0

    topClasses = "#{bn} js-beatmap-discussion-jump"
    topClasses += " #{bn}--highlighted" if @props.highlighted

    lineClasses = "#{bn}__line"
    lineClasses += " #{bn}__line--resolved" if @props.discussion.resolved

    div
      className: topClasses
      onClick: @setHighlight

      div className: "#{bn}__timestamp hidden-xs",
        @timestamp() if @props.discussion.timestamp?

      div className: "#{bn}__discussion",
        div className: "#{bn}__top",
          @post @props.discussion.beatmap_discussion_posts[0], 'discussion'

          div className: "#{bn}__actions",
            ['up', 'down'].map (direction) =>
              div
                key: direction
                className: "#{bn}__action hidden-xs"
                @displayVote direction

            button
              className: "#{bn}__action #{bn}__action--with-line"
              onClick: @toggleExpand
              div
                className: "beatmap-discussion-expand #{'beatmap-discussion-expand--expanded' if !@props.collapsed}"
                el Icon, name: 'chevron-down'
        el ReactCollapse,
          isOpened: !@props.collapsed
          keepCollapsedContent: true
          className: "#{bn}__expanded"
          div
            className: "#{bn}__replies"
            @props.discussion.beatmap_discussion_posts.slice(1).map (reply) =>
              @post reply, 'reply'

          if @props.currentUser.id?
            el BeatmapDiscussions.NewReply,
              currentUser: @props.currentUser
              beatmapset: @props.beatmapset
              currentBeatmap: @props.currentBeatmap
              discussion: @props.discussion
              userPermissions: @props.userPermissions

        div className: lineClasses


  displayVote: (type) ->
    vbn = 'beatmap-discussion-vote'

    [baseScore, icon] = switch type
      when 'up' then [1, 'thumbs-up']
      when 'down' then [-1, 'thumbs-down']

    return if !baseScore?

    currentVote = @props.discussion.current_user_attributes?.vote_score

    score = if currentVote == baseScore then 0 else baseScore

    topClasses = "#{vbn} #{vbn}--#{type}"
    topClasses += " #{vbn}--#{'inactive' if score != 0}"

    button
      className: topClasses
      'data-score': score
      onClick: @doVote
      el Icon, name: icon
      span className: "#{vbn}__count",
        @props.discussion.votes[type]


  doVote: (e) ->
    LoadingOverlay.show()

    $.ajax laroute.route('beatmap-discussions.vote', beatmap_discussion: @props.discussion.id),
      method: 'PUT',
      data:
        beatmap_discussion_vote:
          score: e.currentTarget.dataset.score

    .done (data) =>
      $.publish 'beatmapsetDiscussion:update', beatmapsetDiscussion: data

    .fail osu.ajaxError

    .always LoadingOverlay.hide


  post: (post, type) ->
    elementName = if post.system then 'SystemPost' else 'Post'

    el BeatmapDiscussions[elementName],
      key: post.id
      post: post
      type: type
      read: _.includes(@props.readPostIds, post.id) || (@props.currentUser.id == post.user_id)
      user: @props.lookupUser post.user_id
      lastEditor: @props.lookupUser post.last_editor_id
      canBeEdited: @props.currentUser.isAdmin || (@props.currentUser.id == post.user_id)


  setHighlight: ->
    return if @props.highlighted

    $.publish 'beatmapDiscussion:setHighlight', id: @props.discussion.id


  timestamp: ->
    tbn = 'beatmap-discussion-timestamp'

    div className: tbn,
      div className: "#{tbn}__point"
      div className: "#{tbn}__icons-container",
        div className: "#{tbn}__icons",
          div className: "#{tbn}__icon",
            span
              className: "beatmap-discussion-message-type beatmap-discussion-message-type--#{@props.discussion.message_type}"
              el Icon, name: BeatmapDiscussionHelper.messageType.icon[@props.discussion.message_type]

          if @props.discussion.resolved
            div className: "#{tbn}__icon #{tbn}__icon--resolved",
              el Icon, name: 'check-circle-o'

        div className: "#{tbn}__text",
          BeatmapDiscussionHelper.formatTimestamp @props.discussion.timestamp


  toggleExpand: ->
    $.publish 'beatmapDiscussion:collapse', id: @props.discussion.id
