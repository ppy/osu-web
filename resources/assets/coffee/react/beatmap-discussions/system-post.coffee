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

bn = 'beatmap-discussion-system-post'

BeatmapDiscussions.SystemPost = React.createClass
  mixins: [React.addons.PureRenderMixin]


  render: ->
    message =
      switch @props.post.message.type
        when 'resolved'
          Lang.get "beatmap_discussions.system.resolved.#{@props.post.message.value}",
            user: laroute.link_to_route('users.show', @props.user.username, users: @props.user.id)

    div
      className: bn
      dangerouslySetInnerHTML:
        __html: message
