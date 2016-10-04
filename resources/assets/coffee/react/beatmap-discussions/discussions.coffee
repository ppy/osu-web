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


  render: ->
    @reboot()

    div
      className: bn

      div className: "#{bn}__toolbar",
        div null,
          ['general', 'timeline'].map @modeSwitchButton

        div null,
          button
            className: "btn-osu-lite btn-osu-lite--default btn-osu-lite--beatmap-discussion"
            onClick: => $.publish 'beatmapDiscussion:collapse', all: 'collapse'
            el Icon, name: 'minus-circle'
            span className: 'btn-osu-lite__right',
              osu.trans('beatmaps.discussions.collapse.all-collapse')

          button
            className: "btn-osu-lite btn-osu-lite--default btn-osu-lite--beatmap-discussion"
            onClick: => $.publish 'beatmapDiscussion:collapse', all: 'expand'
            el Icon, name: 'plus-circle'
            span className: 'btn-osu-lite__right',
              osu.trans('beatmaps.discussions.collapse.all-expand')

      div
        className: "#{bn}__discussions"
        if @props.mode == 'timeline'
          div className: "#{bn}__timeline-line hidden-xs"

        div className: "#{bn}__discussions",
          @currentDiscussions.map @discussionPage

          if !@hasDiscussion?
            div className: "#{bn}__discussion #{bn}__discussion--empty", osu.trans 'beatmaps.discussions.empty.empty'
          else if @hasDiscussion == 'filtered'
            div className: "#{bn}__discussion #{bn}__discussion--empty", osu.trans 'beatmaps.discussions.empty.filtered'

      if @props.mode == 'timeline'
        div className: "#{bn}__mode-circle #{bn}__mode-circle--active hidden-xs"


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
          osu.trans("#{lp}.mode.#{mode}")

  discussionPage: (discussion) ->
    className = "#{bn}__discussion"
    hidden =
      if !@currentBeatmap(discussion)
        true
      else if @filtered(discussion)
        @hasDiscussion ?= 'filtered'
        true
      else
        @hasDiscussion = 'visible'
        false

    className += ' hidden' if hidden

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
        readPostIds: @props.readPostIds
        collapsed: _.includes @props.collapsedBeatmapDiscussionIds, discussion.id


  currentBeatmap: (discussion) ->
    discussion.beatmap_id == @currentBeatmapId


  filtered: (discussion) ->
    switch @props.currentFilter
      when 'mine' then discussion.user_id != @props.currentUser.id
      when 'resolved' then discussion.message_type == 'praise' || !discussion.resolved
      when 'pending' then discussion.message_type == 'praise' || discussion.resolved
      when 'praises' then discussion.message_type != 'praise'
      else false


  reboot: ->
    @currentDiscussions = _.chain @props.beatmapsetDiscussion.beatmap_discussions.data
      .orderBy ['timestamp', 'id'], ['asc', 'asc']
      .value()

    @currentBeatmapId = if @props.mode == 'general' then null else @props.currentBeatmap.id

    @hasDiscussion = null
