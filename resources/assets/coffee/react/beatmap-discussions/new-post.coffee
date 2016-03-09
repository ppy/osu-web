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
{button, div, input, span, textarea} = React.DOM
el = React.createElement

bn = 'beatmap-discussions-new-post'

BeatmapDiscussions.NewPost = React.createClass
  mixins: [React.addons.PureRenderMixin]


  getInitialState: ->
    message: ''
    messageType: null
    timestamp: ''


  render: ->
    div
      className: bn
      div className: "#{bn}__col #{bn}__col--left",
        div className: "#{bn}__timestamp-box",
          input
            className: "#{bn}__input #{bn}__input--timestamp",
            type: 'text'
            value: @state.timestamp
            onChange: @setTimestamp

      div className: "#{bn}__col #{bn}__col--main",
        div className: "#{bn}__message-box",
          div
            className: "#{bn}__avatar"
            div
              className: 'avatar avatar--full-rounded'
              style:
                backgroundImage: "url('#{@props.user.avatarUrl}')"
          textarea
            className: "#{bn}__message"
            value: @state.message
            onChange: @setMessage

      div className: "#{bn}__col #{bn}__col--right",
        div
          className: "#{bn}__message-types"
          span className: "#{bn}__message-type",
            Lang.get('beatmaps.discussions.message_type_select')

          ['praise', 'suggestion', 'problem'].map (type) =>
            @messageTypeSelection type

        button
          className: "btn-osu-lite btn-osu-lite--default"
          disabled: @state.messageType == null
          onClick: @post
          Lang.get('common.buttons.post')


  setTimestamp: (e) ->
    @setState timestamp: e.target.value


  setMessage: (e) ->
    @setState message: e.target.value


  post: ->
    osu.showLoadingOverlay()

    $.ajax Url.beatmapDiscussions(@props.currentBeatmap.id),
      method: 'POST'
      data:
        beatmap_discussion:
          message: @state.message
          message_type: @state.messageType
          timestamp: @state.timestamp

    .done (data) =>
      @setState
        message: null
        message_type: null
        timestamp: null

      $.publish 'beatmapsetDiscussion:update', data.data

    .fail osu.ajaxError

    .always osu.hideLoadingOverlay


  messageTypeSelection: (type) ->
    do (type) =>
      iconClassesBn = 'beatmap-discussions-post-icon'
      iconClasses = iconClassesBn

      iconClasses += " #{iconClassesBn}--#{type}" if type == @state.messageType

      button
        key: type
        className: "#{bn}__message-type"
        onClick: => @setState messageType: type
        div className: iconClasses,
          el BeatmapDiscussions.PostIcon, messageType: type
          span className: "#{bn}__message-type-text",
            Lang.get("beatmaps.discussions.message_type.#{type}")
