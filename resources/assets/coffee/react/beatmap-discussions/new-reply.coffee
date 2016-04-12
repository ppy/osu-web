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
{button, div, form, input, label, span, textarea} = React.DOM
el = React.createElement

bn = 'beatmap-discussion-post'

BeatmapDiscussions.NewReply = React.createClass
  mixins: [React.addons.PureRenderMixin]


  componentDidMount: ->
    @throttledPost = _.throttle @post, 1000


  getInitialState: ->
    message: ''
    resolveDiscussion: @canUpdate() && @props.discussion.resolved


  render: ->
    div
      className: "#{bn} #{bn}--reply"

      div className: "#{bn}__avatar",
        el UserAvatar, user: @props.currentUser, modifiers: ['full-rounded']

      div className: "#{bn}__message-container",
        textarea
          className: "#{bn}__message #{bn}__message--new-reply"
          type: 'text'
          rows: 2
          value: @state.message
          onChange: @setMessage
          onKeyDown: @submitIfEnter

        div className: "#{bn}__actions",
          div className: "#{bn}__actions-group",
            if @props.discussion.timestamp? && @canUpdate()
              label
                className: 'osu-checkbox'
                input
                  className: 'osu-checkbox__input'
                  type: 'checkbox'
                  checked: @state.resolveDiscussion
                  onChange: (e) => @setState resolveDiscussion: e.target.checked

                span className: 'osu-checkbox__tick',
                  el Icon, name: 'check'

                Lang.get('beatmaps.discussions.resolved')
          div className: "#{bn}__actions-group",
            button
              className: 'btn-osu-lite btn-osu-lite--default'
              disabled: !@validPost()
              onClick: @throttledPost
              Lang.get('common.buttons.reply')


  post: ->
    return if !@validPost()
    LoadingOverlay.show()

    $.ajax Url.beatmapDiscussionPosts,
      method: 'POST'
      data:
        beatmap_discussion_id: @props.discussion.id
        beatmap_discussion:
          resolved: @state.resolveDiscussion
        beatmap_discussion_post:
          message: @state.message

    .done (data) =>
      @setState message: ''
      $.publish 'beatmapDiscussionPost:markRead', id: data.beatmap_discussion_post_id
      $.publish 'beatmapsetDiscussion:update', beatmapsetDiscussion: data.beatmapset_discussion.data

    .fail osu.ajaxError

    .always LoadingOverlay.hide


  setMessage: (e) ->
    newValue = e.target.value

    @setState message: e.target.value


  canUpdate: ->
    return false if !@props.currentUser.id?

    @props.currentUser.isAdmin ||
      @props.currentUser.id == @props.beatmapset.user_id ||
      @props.currentUser.id == @props.discussion.user_id


  validPost: ->
    @state.message.length != 0


  submitIfEnter: (e) ->
    return if e.keyCode != 13

    e.preventDefault()
    @throttledPost()
