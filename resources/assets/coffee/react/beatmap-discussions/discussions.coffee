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
    @currentDiscussions = _.chain @props.beatmapsetDiscussion.beatmap_discussions
      .orderBy ['timestamp', 'id'], ['asc', 'asc']
      .value()
    @currentBeatmapId = if @props.mode == 'general' then null else @props.currentBeatmap.id
    @hasDiscussion = null

    div className: 'osu-page osu-page--small',
      div
        className: bn

        div className: 'page-title',
          osu.trans('beatmaps.discussions.title')

        div className: "#{bn}__toolbar",
          div className: "#{bn}__toolbar-content #{bn}__toolbar-content--right",
            a
              href: '#'
              className: "#{bn}__toolbar-link"
              'data-type': 'collapse'
              onClick: @expand
              el IconExpand, expand: false
              span className: 'btn-osu-lite__right',
                osu.trans('beatmaps.discussions.collapse.all-collapse')

            a
              href: '#'
              className: "#{bn}__toolbar-link"
              'data-type': 'expand'
              onClick: @expand
              el IconExpand
              span className: 'btn-osu-lite__right',
                osu.trans('beatmaps.discussions.collapse.all-expand')

        div
          className: "#{bn}__discussions"

          @timelineCircle()

          if @props.mode == 'timeline'
              div className: "#{bn}__timeline-line hidden-xs"

          div null,
            @currentDiscussions.map @discussionPage

            if !@hasDiscussion?
              div className: "#{bn}__discussion #{bn}__discussion--empty", osu.trans 'beatmaps.discussions.empty.empty'
            else if @hasDiscussion == 'hidden'
              div className: "#{bn}__discussion #{bn}__discussion--empty", osu.trans 'beatmaps.discussions.empty.hidden'

          @timelineCircle()


  discussionPage: (discussion) ->
    className = "#{bn}__discussion"

    if !@currentBeatmap(discussion)
      hidden = true
    else if @hidden(discussion)
      @hasDiscussion ?= 'hidden'
      hidden = true
    else
      @hasDiscussion = 'visible'
      hidden = false

    className += ' u-hide-by-height' if hidden

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


  expand: (e) ->
    e.preventDefault()
    $.publish 'beatmapDiscussion:collapse', all: e.currentTarget.dataset.type


  hidden: (discussion) ->
    switch @props.currentFilter
      when 'mine' then discussion.user_id != @props.currentUser.id
      when 'resolved' then discussion.message_type == 'praise' || !discussion.resolved
      when 'pending' then discussion.message_type == 'praise' || discussion.resolved
      when 'praises' then discussion.message_type != 'praise'
      else false


  timelineCircle: ->
    div
      'data-visibility': if @props.mode != 'timeline' then 'hidden'
      className: "#{bn}__mode-circle #{bn}__mode-circle--active hidden-xs"
