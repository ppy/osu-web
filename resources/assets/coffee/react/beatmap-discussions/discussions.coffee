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
{a, button, div, p, span} = React.DOM
el = React.createElement

bn = 'beatmap-discussions'
lp = 'beatmaps.discussions'

BeatmapDiscussions.Discussions = React.createClass
  mixins: [React.addons.PureRenderMixin]


  componentWillReceiveProps: ->
    @_currentDiscussions = null


  render: ->
    currentBeatmapId = if @props.mode == 'general' then null else @props.currentBeatmap.id

    hasVisibleDiscussion = false

    div
      className: bn

      ['general', 'timeline'].map @modeSwitchButton

      div
        className: "#{bn}__discussions"
        if @props.mode == 'timeline'
          div className: "#{bn}__timeline-line hidden-xs"

        div className: "#{bn}__discussions",
          @currentDiscussions().map (discussion) =>
            className = "#{bn}__discussion"
            if discussion.beatmap_id != currentBeatmapId
              className += ' hidden'
            else
              hasVisibleDiscussion = true

            div
              key: discussion.id
              className: className
              el BeatmapDiscussions.Discussion,
                discussion: discussion
                lookupUser: @props.lookupUser
                currentUser: @props.currentUser
                beatmapset: @props.beatmapset
                currentBeatmap: @props.currentBeatmap
                userPermissions: @props.userPermissions
                highlighted: discussion.id == @props.highlightedDiscussionId
                read: _.includes(@props.readDiscussionIds, discussion.id)
                readReplyIds: @props.readReplyIds

          if !hasVisibleDiscussion
            div className: "#{bn}__discussion #{bn}__discussion--empty", Lang.get 'beatmaps.discussions.empty'

      if @props.mode == 'timeline'
        div className: "#{bn}__mode-circle #{bn}__mode-circle--active hidden-xs"


  currentDiscussions: ->
    if !@_currentDiscussions?
      @_currentDiscussions = _.chain @props.beatmapsetDiscussion.beatmap_discussions.data
        .orderBy ['timestamp', 'id'], ['asc', 'asc']
        .value()

    @_currentDiscussions


  modeSwitchButton: (mode) ->
    circleClass = "#{bn}__mode-circle"
    circleClass += " #{bn}__mode-circle--active" if mode == @props.mode

    button
      key: "mode-#{mode}"
      className: "#{bn}__mode"
      onClick: => $.publish 'beatmapDiscussion:setMode', mode
      div className: "#{bn}__mode-container",
        div className: circleClass
        if mode == 'timeline' && mode == @props.mode
          div className: "#{bn}__timeline-line #{bn}__timeline-line--bottom #{bn}__timeline-line--half hidden-xs"
        span className: "#{bn}__mode-text",
          Lang.get("#{lp}.mode.#{mode}")
