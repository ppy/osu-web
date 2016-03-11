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
{button, div, form, input} = React.DOM
el = React.createElement

bn = 'beatmap-discussion-post'

BeatmapDiscussions.NewReply = React.createClass
  mixins: [React.addons.PureRenderMixin]


  getInitialState: ->
    message: ''


  render: ->
    form
      className: bn
      onSubmit: @post
      button className: 'hidden'

      div className: "#{bn}__avatar",
        div
          className: 'avatar avatar--full-rounded'
          style:
            backgroundImage: "url('#{@props.currentUser.avatarUrl}')"
      div className: "#{bn}__message-container",
        input
          className: "#{bn}__message #{bn}__message--new-reply"
          type: 'text'
          value: @state.message
          onChange: @setMessage


  post: (e) ->
    e.preventDefault()

    # osu.showLoadingOverlay already called by global listener

    $.ajax Url.beatmapDiscussionReplies(@props.discussion.beatmap_id, @props.discussion.id),
      method: 'POST'
      data:
        beatmap_discussion_reply:
          message: @state.message

    .done (data) =>
      @setState message: ''
      $.publish 'beatmapsetDiscussion:update', data.data

    .fail osu.ajaxError

    .always osu.hideLoadingOverlay


  setMessage: (e) ->
    @setState message: e.target.value
