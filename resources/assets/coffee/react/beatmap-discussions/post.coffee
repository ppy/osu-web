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
{button, div, span, textarea} = React.DOM
el = React.createElement

bn = 'beatmap-discussion-post'

BeatmapDiscussions.Post = React.createClass
  mixins: [React.addons.PureRenderMixin]


  getInitialState: ->
    editing: false
    message: @props.post.message


  componentDidMount: ->
    osu.pageChange()

    @throttledUpdatePost = _.throttle @updatePost, 1000


  componentDidUpdate: ->
    osu.pageChange()


  render: ->
    topClasses = "#{bn} #{bn}--#{@props.type}"
    topClasses += " #{bn}--editing" if @state.editing

    div
      className: topClasses
      key: "#{@props.type}-#{@props.post.id}"
      onClick: =>
        $.publish 'beatmapDiscussionPost:markRead', id: @props.post.id

      div
        className: "#{bn}__content"
        div className: "#{bn}__avatar",
          el UserAvatar, user: @props.user, modifiers: ['full-rounded']

        @messageViewer()
        @messageEditor()


  addEditorLink: (message) ->
    _.chain message
      .escape()
      .replace /(^|\s)((\d{2}):(\d{2})[:.](\d{3})( \([\d,|]+\))?(?=\s))/g, (_, prefix, text, m, s, ms, range) =>
        "#{prefix}#{osu.link(Url.openBeatmapEditor("#{m}:#{s}:#{ms}#{range ? ''}"), text)}"
      .value()


  messageInput: (e) ->
    @setState message: e.target.value


  submitIfEnter: (e) ->
    return if e.keyCode != 13

    e.preventDefault()
    @throttledUpdatePost()


  updatePost: ->
    return if @state.message == @props.post.message

    LoadingOverlay.show()

    $.ajax laroute.route('beatmap-discussion-posts.update', beatmap_discussion_post: @props.post.id),
      method: 'PUT'
      data:
        beatmap_discussion_post:
          message: @state.message

    .done (data) =>
      @setState editing: false
      $.publish 'beatmapsetDiscussion:update', beatmapsetDiscussion: data.beatmapset_discussion

    .fail osu.ajaxError

    .always LoadingOverlay.hide


  editStart: ->
    @setState editing: true, =>
      @refs.textarea.focus()


  editEnd: ->
    @setState editing: false


  messageViewer: ->
    div className: "#{bn}__message-container #{'hidden' if @state.editing}",
      div
        className: "#{bn}__message"
        dangerouslySetInnerHTML:
          __html: osu.linkify(@addEditorLink @props.post.message)

      div className: "#{bn}__info-container",
        span
          className: "#{bn}__info"
          dangerouslySetInnerHTML:
            __html: "#{osu.link laroute.route('users.show', user: @props.user.id),
              @props.user.username
              classNames: ["#{bn}__info-user"]
              }, #{osu.timeago @props.post.created_at}"

        if @props.post.updated_at != @props.post.created_at
          span
            className: "#{bn}__info #{bn}__info--edited"
            dangerouslySetInnerHTML:
              __html: osu.trans 'beatmaps.discussions.edited',
                editor: laroute.link_to_route('users.show', @props.lastEditor.username, user: @props.lastEditor.id)
                update_time: osu.timeago @props.post.updated_at

      if @props.canBeEdited
        div
          className: "#{bn}__actions"
          div
            className: "#{bn}__actions-group"
            button
              className: "#{bn}__action #{bn}__action--button"
              onClick: @editStart
              osu.trans('beatmaps.discussions.edit')


  messageEditor: ->
    return if !@props.canBeEdited

    div className: "#{bn}__message-container #{'hidden' if !@state.editing}",
      textarea
        ref: 'textarea'
        className: "#{bn}__message #{bn}__message--editor"
        onChange: @messageInput
        onKeyDown: @submitIfEnter
        value: @state.message

      div className: "#{bn}__actions",
        div className: "#{bn}__actions-group"

        div className: "#{bn}__actions-group",
          div className: "#{bn}__action",
            button
              className: 'btn-osu-lite btn-osu-lite--default'
              onClick: @editEnd
              osu.trans 'common.buttons.cancel'

          div className: "#{bn}__action",
            button
              className: 'btn-osu-lite btn-osu-lite--default'
              onClick: @throttledUpdatePost
              osu.trans 'common.buttons.save'
