###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

{button, div, span} = ReactDOMFactories
el = React.createElement

bn = 'beatmap-discussion-system-post'

BeatmapDiscussions.SystemPost = (props) ->
  message =
    switch props.post.message.type
      when 'resolved'
        osu.trans "beatmap_discussions.system.resolved.#{props.post.message.value}",
          user: osu.link laroute.route('users.show', user: props.user.id), props.user.username,
            classNames: ["#{bn}__user"]

  topClass = "#{bn} #{bn}--#{props.post.message.type}"
  topClass += " #{bn}--deleted" if props.post.deleted_at

  div
    className: topClass
    div
      className: "#{bn}__content"
      dangerouslySetInnerHTML:
        __html: message
