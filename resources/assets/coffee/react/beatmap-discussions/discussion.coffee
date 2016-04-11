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
  mixins: [React.addons.PureRenderMixin]


  getInitialState: ->
    collapsed: false


  componentDidMount: ->
    osu.pageChange()


  componentDidUpdate: ->
    osu.pageChange()


  render: ->
    return div() if @props.discussion.beatmap_discussion_posts.data.length == 0

    topClasses = "#{bn} js-beatmap-discussion-jump"
    topClasses += " #{bn}--highlighted" if @props.highlighted

    div
      className: topClasses
      'data-id': @props.discussion.id
      onClick: @setHighlight

      div className: "#{bn}__timestamp hidden-xs",
        @timestamp() if @props.discussion.timestamp?

      div className: "#{bn}__discussion",
        div className: "#{bn}__top",
          @post @props.discussion.beatmap_discussion_posts.data[0], 'discussion'

          div className: "#{bn}__actions",
            ['up', 'down'].map (direction) =>
              div
                key: direction
                className: "#{bn}__action hidden-xs"
                @displayVote direction

            button
              className: "#{bn}__action #{bn}__action--with-line"
              onClick: => @setState collapsed: !@state.collapsed
              div className: 'beatmap-discussion-expand',
                el Icon, name: (if @state.collapsed then 'chevron-down' else 'chevron-up')
        div
          className: "#{bn}__replies #{'hidden' if @state.collapsed}"
          @props.discussion.beatmap_discussion_posts.data.slice(1).map (reply) =>
            @post reply, 'reply'

          if @props.currentUser.id?
            el BeatmapDiscussions.NewReply,
              currentUser: @props.currentUser
              beatmapset: @props.beatmapset
              currentBeatmap: @props.currentBeatmap
              discussion: @props.discussion
              userPermissions: @props.userPermissions

        div
          className: "#{bn}__resolved #{'hidden' if @state.collapsed || !@props.discussion.resolved}"
          Lang.get 'beatmaps.discussions.resolved'


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


  post: (post, type = '') ->
    pbn = 'beatmap-discussion-post'
    user = @props.lookupUser post.user_id
    read = _.includes @props.readPostIds, post.id

    topClasses = "#{pbn} #{pbn}--#{type}"
    topClasses += " #{pbn}--unread" if !read

    div
      className: topClasses
      key: "#{type}-#{post.id}"
      onClick: =>
        $.publish 'beatmapDiscussionPost:markRead', id: post.id

      div className: "#{pbn}__avatar",
        el UserAvatar, user: user, modifiers: ['full-rounded']

      div className: "#{pbn}__message-container",
        div
          className: "#{pbn}__message #{pbn}__message--#{type}"
          dangerouslySetInnerHTML:
            __html: @addEditorLink post.message
        div
          className: "#{pbn}__info"
          dangerouslySetInnerHTML:
            __html: "#{osu.link Url.user(user.id), user.username}, #{osu.timeago post.created_at}"


  addEditorLink: (message) ->
    _.chain message
      .escape()
      .replace /(^|\s)((\d{2}):(\d{2})[:.](\d{3})( \([\d,]+\))?(?=\s))/g, (_, prefix, text, m, s, ms, range) =>
        "#{prefix}#{osu.link Url.openBeatmapEditor("#{m}:#{s}:#{ms}#{range ? ''}"), text}"
      .value()


  doVote: (score) ->
    LoadingOverlay.show()

    $.ajax Url.beatmapDiscussionVote(@props.discussion.id),
      method: 'PUT',
      data:
        beatmap_discussion_vote:
          score: score

    .done (data) =>
      $.publish 'beatmapsetDiscussion:update', beatmapsetDiscussion: data.data

    .fail osu.ajaxError

    .always LoadingOverlay.hide


  displayVote: (type) ->
    vbn = 'beatmap-discussion-vote'

    [baseScore, icon] = switch type
      when 'up' then [1, 'thumbs-up']
      when 'down' then [-1, 'thumbs-down']

    return if !baseScore?

    currentVote = @props.discussion.current_user_attributes?.data?.vote_score

    classes = "#{vbn} #{vbn}--#{type}"

    score = if currentVote == baseScore then 0 else baseScore

    div className: classes,
      button
        className: "#{vbn}__button"
        onClick: => @doVote score
        el Icon, name: icon
      span className: "#{vbn}__count #{"#{vbn}__count--inactive" if score != 0}",
        @props.discussion.votes[type]


  setHighlight: ->
    return if @props.highlighted

    $.publish 'beatmapDiscussion:setHighlight', id: @props.discussion.id
