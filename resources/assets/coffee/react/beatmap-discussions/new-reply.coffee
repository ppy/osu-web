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


  componentWillUnmount: ->
    @throttledPost.cancel()
    @postXhr?.abort()


  getInitialState: ->
    message: ''
    resolveDiscussion: @props.discussion.resolved


  render: ->
    div
      className: "#{bn} #{bn}--reply #{bn}--editing-dark"

      div
        className: "#{bn}__content"
        div className: "#{bn}__avatar",
          el UserAvatar, user: @props.currentUser, modifiers: ['full-rounded']

        div className: "#{bn}__message-container",
          textarea
            className: "#{bn}__message #{bn}__message--editor"
            type: 'text'
            rows: 2
            value: @state.message
            onChange: @setMessage
            onKeyDown: @submitIfEnter
            placeholder: osu.trans 'beatmaps.discussions.reply_placeholder'

      div
        className: "#{bn}__footer"
        div className: "#{bn}__actions",
          div className: "#{bn}__actions-group",
            if @props.discussion.timestamp? && @canUpdate()
              div className: "#{bn}__action",
                label
                  className: 'osu-checkbox'
                  input
                    className: 'osu-checkbox__input'
                    type: 'checkbox'
                    checked: @state.resolveDiscussion
                    onChange: @toggleResolveDiscussion

                  span className: 'osu-checkbox__tick',
                    el Icon, name: 'check'

                  osu.trans('beatmaps.discussions.resolved')
          div className: "#{bn}__actions-group",
            div className: "#{bn}__action",
              el BigButton,
                text: osu.trans('common.buttons.reply')
                icon: 'reply'
                props:
                  disabled: !@validPost()
                  onClick: @throttledPost


  canUpdate: ->
    return false if !@props.currentUser.id?

    @props.currentUser.isAdmin ||
      @props.currentUser.id == @props.beatmapset.user_id ||
      @props.currentUser.id == @props.discussion.user_id


  post: ->
    return if !@validPost()
    LoadingOverlay.show()

    @postXhr?.abort()

    @postXhr = $.ajax laroute.route('beatmap-discussion-posts.store'),
      method: 'POST'
      data:
        beatmap_discussion_id: @props.discussion.id
        beatmap_discussion:
          resolved: @state.resolveDiscussion
        beatmap_discussion_post:
          message: @state.message

    .done (data) =>
      @setState message: ''
      $.publish 'beatmapDiscussionPost:markRead', id: data.beatmap_discussion_post_ids
      $.publish 'beatmapsetDiscussion:update', beatmapsetDiscussion: data.beatmapset_discussion

    .fail osu.ajaxError

    .always LoadingOverlay.hide


  setMessage: (e) ->
    @setState message: e.target.value


  submitIfEnter: (e) ->
    return if e.keyCode != 13

    e.preventDefault()
    @throttledPost()


  toggleResolveDiscussion: (e) ->
    @setState resolveDiscussion: e.target.checked


  validPost: ->
    @state.message.length != 0
