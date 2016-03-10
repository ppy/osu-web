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
{div, span} = React.DOM
el = React.createElement

bn = 'beatmap-discussion'

BeatmapDiscussions.Discussion = React.createClass
  mixins: [React.addons.PureRenderMixin]


  componentDidUpdate: ->
    osu.pageChange()


  render: ->
    div className: bn,
      div className: "#{bn}__timestamp-line"
      div className: "#{bn}__timestamp-container",
        div className: "#{bn}__timestamp-point"
        div className: "#{bn}__icons-container",
          div className: "#{bn}__icons",
            div className: "#{bn}__icon",
              span
                className: "beatmap-discussion-message-type beatmap-discussion-message-type--#{@props.discussion.message_type}"
                el BeatmapDiscussions.MessageIcon, messageType: @props.discussion.message_type
          div className: "#{bn}__timestamp",
            osu.formatBeatmapTimestamp(@props.discussion.timestamp)

      div className: "#{bn}__discussion",
        @post @props.discussion, 'discussion'
        @props.discussion.beatmap_discussion_replies.data.map (reply) =>
          @post reply, 'reply'

        el BeatmapDiscussions.NewReply, currentUser: @props.currentUser, beatmapset: @props.beatmapset


  post: (post, type = '') ->
    user = post.user.data

    div
      className: "#{bn}__post #{bn}__post--#{type}"
      key: "#{type}-#{post.id}"
      div className: "#{bn}__avatar",
        div
          className: 'avatar avatar--full-rounded'
          style:
            backgroundImage: "url('#{user.avatarUrl}')"
      div className: "#{bn}__message-container",
        div className: "#{bn}__message #{bn}__message--#{type}", post.message
        div
          className: "#{bn}__info"
          dangerouslySetInnerHTML:
            __html: "#{osu.link Url.user(user.id), user.username}, #{osu.timeago post.created_at}"
