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

bn = 'beatmap-discussion-post'

BeatmapDiscussions.Post = React.createClass
  mixins: [React.addons.PureRenderMixin]


  componentDidMount: ->
    osu.pageChange()


  componentDidUpdate: ->
    osu.pageChange()


  render: ->
    topClasses = "#{bn} #{bn}--#{@props.type}"
    topClasses += " #{bn}--unread" if !@props.read

    div
      className: topClasses
      key: "#{@props.type}-#{@props.post.id}"
      onClick: =>
        $.publish 'beatmapDiscussionPost:markRead', id: @props.post.id

      div className: "#{bn}__avatar",
        el UserAvatar, user: @props.user, modifiers: ['full-rounded']

      div className: "#{bn}__message-container",
        div
          className: "#{bn}__message #{bn}__message--#{@props.type}"
          dangerouslySetInnerHTML:
            __html: @addEditorLink @props.post.message
        div
          className: "#{bn}__info"
          dangerouslySetInnerHTML:
            __html: "#{osu.link Url.user(@props.user.id), @props.user.username}, #{osu.timeago @props.post.created_at}"


  addEditorLink: (message) ->
    _.chain message
      .escape()
      .replace /(^|\s)((\d{2}):(\d{2})[:.](\d{3})( \([\d,|]+\))?(?=\s))/g, (_, prefix, text, m, s, ms, range) =>
        "#{prefix}#{osu.link Url.openBeatmapEditor("#{m}:#{s}:#{ms}#{range ? ''}"), text}"
      .value()
