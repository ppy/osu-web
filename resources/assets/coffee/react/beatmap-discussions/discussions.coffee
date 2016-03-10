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
{a, div, p, span} = React.DOM
el = React.createElement

bn = 'beatmap-discussions'
lp = 'beatmaps.discussions'

BeatmapDiscussions.Discussions = React.createClass
  mixins: [React.addons.PureRenderMixin]


  getInitialState: ->
    mode: 'timeline'


  componentWillReceiveProps: ->
    @_currentDiscussions = null


  render: ->
    div
      className: bn

      ['general', 'timeline'].map (mode) =>
        circleClass = "#{bn}__mode-circle"
        circleClass += " #{bn}__mode-circle--active" if mode == @state.mode

        div
          key: "mode-#{mode}"
          className: "#{bn}__mode"
          div className: circleClass
          if mode == 'timeline' && mode == @state.mode
            div className: "#{bn}__timeline-line #{bn}__timeline-line--bottom #{bn}__timeline-line--half"
          span className: "#{bn}__mode-text",
            Lang.get("#{lp}.mode.#{mode}")

      div
        className: "#{bn}__discussions"
        if @state.mode == 'timeline'
          div className: "#{bn}__timeline-line"

        div className: "#{bn}__discussions",
          @currentDiscussions().map (discussion) =>
            div
              key: discussion.id
              className: "#{bn}__discussion"
              el BeatmapDiscussions.Discussion,
                discussion: discussion
                currentUser: @props.currentUser
                beatmapset: @props.beatmapset
                currentBeatmap: @props.currentBeatmap

      if @state.mode == 'timeline'
        div className: "#{bn}__mode-circle #{bn}__mode-circle--active"


  currentDiscussions: ->
    @_currentDiscussions ?= @props.beatmapsetDiscussion.beatmap_discussions.data.filter (discussion) =>
      discussion.beatmap_id == @props.currentBeatmap.id && discussion.timestamp
