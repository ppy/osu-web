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


  componentDidUpdate: ->
    osu.pageChange()


  render: ->
    div className: bn,
      div className: "#{bn}__timestamp",
        @timestamp() if @props.discussion.timestamp

      div className: "#{bn}__discussion",
        div className: "#{bn}__top",
          @post @props.discussion, 'discussion'

          div className: "#{bn}__actions",
            button
              className: "#{bn}__action #{bn}__action--with-line"
              onClick: => @setState collapsed: !@state.collapsed
              div className: "#{bn}__action-content",
                el Icon, name: (if @state.collapsed then 'chevron-down' else 'chevron-up')
        div
          className: "#{bn}__replies #{'hidden' if @state.collapsed}"
          @props.discussion.beatmap_discussion_replies.data.map (reply) =>
            @post reply, 'reply'

          if @props.currentUser.id != undefined
            el BeatmapDiscussions.NewReply,
              currentUser: @props.currentUser
              beatmapset: @props.beatmapset
              currentBeatmap: @props.currentBeatmap
              discussion: @props.discussion
              userPermissions: @props.userPermissions


  timestamp: ->
    tbn = 'beatmap-discussion-timestamp'

    div className: tbn,
      div className: "#{tbn}__point"
      div className: "#{tbn}__icons-container",
        div className: "#{tbn}__icons",
          div className: "#{tbn}__icon",
            span
              className: "beatmap-discussion-message-type beatmap-discussion-message-type--#{@props.discussion.message_type}"
              el BeatmapDiscussions.MessageIcon, messageType: @props.discussion.message_type

          if @props.discussion.resolved
            div className: "#{tbn}__icon #{tbn}__icon--resolved",
              el Icon, name: 'check-circle-o'

        div className: "#{tbn}__text",
          osu.formatBeatmapTimestamp(@props.discussion.timestamp)


  post: (post, type = '') ->
    pbn = 'beatmap-discussion-post'
    user = post.user.data

    div
      className: pbn
      key: "#{type}-#{post.id}"

      div className: "#{pbn}__avatar",
        el UserAvatar, user: user, modifiers: ['full-rounded']

      div className: "#{pbn}__message-container",
        div className: "#{pbn}__message #{pbn}__message--#{type}", post.message
        div
          className: "#{pbn}__info"
          dangerouslySetInnerHTML:
            __html: "#{osu.link Url.user(user.id), user.username}, #{osu.timeago post.created_at}"
