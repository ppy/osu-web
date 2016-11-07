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
{button, div, input, p, span, textarea} = React.DOM
el = React.createElement

bn = 'beatmap-discussion-new'

BeatmapDiscussions.NewDiscussion = React.createClass
  mixins: [React.addons.PureRenderMixin]


  getInitialState: ->
    message: ''
    timestamp: null


  componentDidMount: ->
    @throttledPost = _.throttle @post, 1000


  componentWillUnmount: ->
    @throttledPost.cancel()


  render: ->
    div
      className: 'osu-page osu-page--small'
      div
        className: bn
        div className: "page-title",
          osu.trans('beatmaps.discussions.new.title')

        div className: "#{bn}__content",
          div
            className: "#{bn}__avatar"
            el UserAvatar, user: @props.currentUser, modifiers: ['full-rounded']

          div className: "#{bn}__message",
            if @props.currentUser.id?
              textarea
                className: "#{bn}__message-area"
                value: @state.message
                onChange: @setMessage
                placeholder: osu.trans 'beatmaps.discussions.message_placeholder'
            else
              osu.trans('beatmaps.discussions.require-login')

        div className: "#{bn}__footer",
          div
            className: "#{bn}__footer-content"
            'data-visibility': if @props.mode != 'timeline' then 'hidden'
            div
              key: 'label'
              className: "#{bn}__timestamp-col #{bn}__timestamp-col--label"
              osu.trans('beatmaps.discussions.new.timestamp')
            div
              key: 'timestamp'
              className: "#{bn}__timestamp-col"
              BeatmapDiscussionHelper.formatTimestamp @state.timestamp

          div
            className: "#{bn}__footer-content #{bn}__footer-content--right"
            ['praise', 'suggestion', 'problem'].map @messageTypeSelection


  setTimestamp: (e) ->
    @setState timestamp: e.currentTarget.value


  setMessage: (e) ->
    @setState message: e.currentTarget.value, @parseTimestamp


  post: (e) ->
    return unless @validPost()

    LoadingOverlay.show()

    data =
        beatmapset_id: @props.currentBeatmap.beatmapset_id
        beatmap_discussion_post:
          message: @state.message

    if @state.timestamp?
      data.beatmap_discussion =
        message_type: e.currentTarget.dataset.type
        timestamp: @state.timestamp
        beatmap_id: @props.currentBeatmap.id

    $.ajax laroute.route('beatmap-discussion-posts.store'),
      method: 'POST'
      data: data

    .done (data) =>
      @setState
        message: ''
        message_type: null
        timestamp: null

      $.publish 'beatmapDiscussionPost:markRead', id: data.beatmap_discussion_post_id
      $.publish 'beatmapsetDiscussion:update',
        beatmapsetDiscussion: data.beatmapset_discussion,
        callback: =>
          $.publish 'beatmapDiscussion:jump', id: data.beatmap_discussion_id

    .fail osu.ajaxError

    .always LoadingOverlay.hide


  messageTypeSelection: (type) ->
    button
      key: type
      className: 'btn-osu-big btn-osu-big--beatmap-discussion'
      disabled: !@validPost()
      'data-type': type
      onClick: @post
      div className: 'btn-osu-big__content',
        span className: 'btn-osu-big__left',
          osu.trans("beatmaps.discussions.message_type.#{type}")
        el Icon, name: BeatmapDiscussionHelper.messageType.icon[type]


  validPost: ->
    return false if @state.message.length == 0

    if @props.mode == 'timeline'
      @state.timestamp?
    else
      true


  parseTimestamp: ->
    timestampRe = @state.message.match /^(\d{2}):(\d{2})[:.](\d{3}) /

    @setState timestamp:
      if timestampRe?
        timestamp = timestampRe.slice(1).map (x) => parseInt x, 10

        # this isn't all that smart
        (timestamp[0] * 60 + timestamp[1]) * 1000 + timestamp[2]
      else
        null
