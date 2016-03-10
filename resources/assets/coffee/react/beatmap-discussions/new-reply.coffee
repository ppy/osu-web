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

bn = 'beatmap-discussion-reply-new'

BeatmapDiscussions.NewReply = React.createClass
  mixins: [React.addons.PureRenderMixin]


  render: ->
    return div()

    div className: "#{bn}__discussion #{bn}__discussion--new-reply",
      div className: "#{bn}__avatar",
        div
          className: 'avatar avatar--full-rounded'
          style:
            backgroundImage: "url('#{@props.currentUser.avatarUrl}')"
      div className: "#{bn}__message-container",
        div className: "#{bn}__message #{bn}__message--new-reply", @state.message
        div
          className: "#{bn}__info"
          dangerouslySetInnerHTML:
            __html: "#{osu.link Url.user(user.id), user.username}, #{osu.timeago post.created_at}"
