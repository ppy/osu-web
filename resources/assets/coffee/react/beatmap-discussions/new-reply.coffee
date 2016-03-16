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


  getInitialState: ->
    message: ''
    resolveDiscussion: @canUpdate() && @props.discussion.resolved


  render: ->
    div
      className: bn

      div className: "#{bn}__avatar",
        el UserAvatar, user: @props.currentUser, modifiers: ['full-rounded']

      div className: "#{bn}__message-container",
        textarea
          className: "#{bn}__message #{bn}__message--new-reply"
          type: 'text'
          rows: 2
          value: @state.message
          onChange: @setMessage

        div className: "#{bn}__actions",
          div className: "#{bn}__actions-group",
            if @props.discussion.timestamp != null && @canUpdate()
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
              onClick: @post
              Lang.get('common.buttons.reply')


  post: ->
    osu.showLoadingOverlay()

    $.ajax Url.beatmapDiscussionReplies(@props.discussion.beatmap_id, @props.discussion.id),
      method: 'POST'
      data:
        beatmap_discussion:
          resolved: @state.resolveDiscussion
        beatmap_discussion_reply:
          message: @state.message

    .done (data) =>
      @setState message: ''
      $.publish 'beatmapsetDiscussion:update', data.data

    .fail osu.ajaxError

    .always osu.hideLoadingOverlay


  setMessage: (e) ->
    newValue = e.target.value

    if _.last(newValue) != '\n'
      @setState message: e.target.value
    else
      @post()


  canUpdate: ->
    return false unless @props.currentUser

    @props.currentUser.isAdmin ||
      @props.currentUser.id == @props.beatmapset.user_id ||
      @props.currentUser.id == @props.discussion.user_id
