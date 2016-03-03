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
{div} = React.DOM
el = React.createElement

bn = 'beatmap-discussions-post'

BeatmapDiscussions.Post = React.createClass
  mixins: [React.addons.PureRenderMixin]


  render: ->
    post = @props.post
    user = post.user.data

    div className: bn,
      div className: "#{bn}__timestamp-container",
        div className: "#{bn}__timestamp-point"
        div className: "#{bn}__icons-container",
          div className: "#{bn}__icons",
            div className: "#{bn}__icon",
              el BeatmapDiscussions.PostIcon, messageType: post.message_type
          div className: "#{bn}__timestamp",
            moment(@props.post.timestamp).utcOffset(0).format('HH:mm:ss.SSS')

      div className: "#{bn}__post-container",
        div className: "#{bn}__post",
          div className: "#{bn}__avatar",
            div
              className: 'avatar avatar--full-rounded'
              style:
                backgroundImage: "url('#{user.avatarUrl}')"
          div className: "#{bn}__message-container",
            div className: "#{bn}__message", post.message
            div
              className: "#{bn}__info"
              dangerouslySetInnerHTML:
                __html: "#{osu.link Url.user(user.id), user.username}, #{osu.timeago post.created_at}"
