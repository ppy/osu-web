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

bn = 'beatmap-discussion-new'

BeatmapDiscussions.NewDiscussion = React.createClass
  mixins: [React.addons.PureRenderMixin]


  getInitialState: ->
    message: ''
    messageType: null
    timestamp: null


  render: ->
    div
      className: bn
      div className: "#{bn}__col #{bn}__col--left",
        div className: "#{bn}__timestamp-box",
          div className: "#{bn}__types",
            _.map { general: 'circle-o' , timeline: 'clock-o' }, (icon, type) =>
              span
                key: type
                className: "#{bn}__type #{bn}__type--#{'active' if @currentType() == type}"
                el Icon, name: icon

          if @currentType() == 'timeline'
            div
              className: "#{bn}__timestamp"
              osu.formatBeatmapTimestamp @state.timestamp

      div className: "#{bn}__col #{bn}__col--main",
        div className: "#{bn}__message-box",
          div
            className: "#{bn}__avatar"
            el UserAvatar, user: @props.currentUser, modifiers: ['full-rounded']

          if @props.currentUser.id == undefined
            div className: "#{bn}__message",
              Lang.get('beatmaps.discussions.require-login')
          else
            textarea
              className: "#{bn}__message"
              value: @state.message
              onChange: @setMessage

      div className: "#{bn}__col #{bn}__col--right",
        div
          className: "#{bn}__message-types #{bn}__message-types--#{'disabled' if @currentType() != 'timeline'}"
          span className: "#{bn}__message-type",
            Lang.get('beatmaps.discussions.message_type_select')

          ['praise', 'suggestion', 'problem'].map (type) =>
            @messageTypeSelection type

        button
          className: "btn-osu-lite btn-osu-lite--default"
          disabled: !@canPost()
          onClick: @post
          Lang.get('common.buttons.post')


  setTimestamp: (e) ->
    @setState timestamp: e.target.value


  setMessage: (e) ->
    @setState message: e.target.value, @parseTimestamp


  post: ->
    return unless @canPost()

    osu.showLoadingOverlay()

    data =
        beatmap_discussion:
          message: @state.message

    if @state.timestamp
      data.beatmap_discussion.message_type = @state.messageType
      data.beatmap_discussion.timestamp = @state.timestamp

    $.ajax Url.beatmapDiscussions(@props.currentBeatmap.id),
      method: 'POST'
      data: data

    .done (data) =>
      @setState
        message: ''
        message_type: null
        timestamp: null

      $.publish 'beatmapsetDiscussion:update', data.data

    .fail osu.ajaxError

    .always osu.hideLoadingOverlay


  messageTypeSelection: (type) ->
    do (type) =>
      iconClassesBn = 'beatmap-discussion-message-type'
      iconClasses = iconClassesBn

      if @currentType() == 'timeline' && @state.messageType == type
        iconClasses += " #{iconClassesBn}--#{type}"

      button
        key: type
        className: "#{bn}__message-type"
        onClick: => @setState messageType: type
        div className: iconClasses,
          el BeatmapDiscussions.MessageIcon, messageType: type
          span className: "#{bn}__message-type-text",
            Lang.get("beatmaps.discussions.message_type.#{type}")


  canPost: ->
    return false if @state.message.length == 0

    @state.timestamp == null || @state.messageType != null


  parseTimestamp: ->
    timestampRe = @state.message.match /^(\d{2}):(\d{2})[:.](\d{3}) /

    @setState timestamp:
      if timestampRe == null
        null
      else
        timestamp = timestampRe.slice(1).map (x) => parseInt x, 10

        # this isn't all that smart
        (timestamp[0] * 60 + timestamp[1]) * 1000 + timestamp[2]



  currentType: ->
    if @state.timestamp != null then 'timeline' else 'general'
