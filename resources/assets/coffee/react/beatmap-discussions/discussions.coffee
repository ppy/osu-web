###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
#
#    This file is part of osu!web. osu!web is distributed with the hope of
#    attracting more community contributions to the core ecosystem of osu!.
#
#    osu!web is free software: you can redistribute it and/or modify
#    it under the terms of the Affero GNU General Public License version 3
#    as published by the Free Software Foundation.
#
#    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
#    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
#    See the GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###

import { Discussion } from './discussion'
import { IconExpand } from 'icon-expand'
import * as React from 'react'
import { a, button, div, i, p, span } from 'react-dom-factories'
el = React.createElement

bn = 'beatmap-discussions'

sortPresets =
  updated_at:
    text: osu.trans('beatmaps.discussions.sort.updated_at')
    sort: (a, b) ->
      if a.last_post_at == b.last_post_at
        b.id - a.id
      else
        Date.parse(b.last_post_at) - Date.parse(a.last_post_at)

  created_at:
    text: osu.trans('beatmaps.discussions.sort.created_at')
    sort: (a, b) ->
      if a.created_at == b.created_at
        a.id - b.id
      else
        Date.parse(a.created_at) - Date.parse(b.created_at)

  # there's obviously no timeline field
  timeline:
    text: osu.trans('beatmaps.discussions.sort.timeline')
    sort: (a, b) ->
      if a.timestamp == b.timestamp
        a.id - b.id
      else
        a.timestamp - b.timestamp


export class Discussions extends React.PureComponent
  constructor: (props) ->
    super props

    @state =
      sort:
        generalAll: 'updated_at'
        general: 'updated_at'
        timeline: 'timeline'
        reviews: 'updated_at'


  render: =>
    discussions = @props.currentDiscussions[@props.mode]

    div className: 'osu-page osu-page--small osu-page--full',
      div
        className: bn

        div className: 'page-title',
          osu.trans('beatmaps.discussions.title')

        div className: "#{bn}__toolbar",
          div className: "#{bn}__toolbar-content #{bn}__toolbar-content--left",
            div
              className: "#{bn}__toolbar-item"
              @renderSortOptions()
          div className: "#{bn}__toolbar-content #{bn}__toolbar-content--right",
            @renderShowDeletedToggle()

            button
              type: 'button'
              className: "#{bn}__toolbar-item #{bn}__toolbar-item--link"
              'data-type': 'collapse'
              onClick: @expand
              el IconExpand,
                expand: false
                parentClass: "#{bn}__toolbar-link-content"
              span className: "#{bn}__toolbar-link-content",
                osu.trans('beatmaps.discussions.collapse.all-collapse')

            button
              type: 'button'
              className: "#{bn}__toolbar-item #{bn}__toolbar-item--link"
              'data-type': 'expand'
              onClick: @expand
              el IconExpand,
                parentClass: "#{bn}__toolbar-link-content"
              span className: "#{bn}__toolbar-link-content",
                osu.trans('beatmaps.discussions.collapse.all-expand')


        if discussions.length == 0
          div className: "#{bn}__discussions #{bn}__discussions--empty",
            osu.trans 'beatmaps.discussions.empty.empty'

        else if _.size(@props.currentDiscussions.byFilter[@props.currentFilter][@props.mode]) == 0
          div className: "#{bn}__discussions #{bn}__discussions--empty",
            osu.trans 'beatmaps.discussions.empty.hidden'

        else
          div
            className: "#{bn}__discussions"
            @timelineCircle()

            if @isTimelineVisible()
              div className: "#{bn}__timeline-line hidden-xs"

            div null,
              @sortedDiscussions().map @discussionPage

            @timelineCircle()


  renderShowDeletedToggle: =>
    return null unless BeatmapDiscussionHelper.canModeratePosts(@props.currentUser)

    button
      type: 'button'
      className: "#{bn}__toolbar-item #{bn}__toolbar-item--link"
      onClick: @toggleShowDeleted
      span className: "#{bn}__toolbar-link-content",
        span
          className: if @props.showDeleted then 'fas fa-check-square' else 'far fa-square'
      span className: "#{bn}__toolbar-link-content",
        osu.trans('beatmaps.discussions.show_deleted')


  renderSortOptions: =>
    presets =
      switch @props.mode
        when 'timeline'
          ['timeline', 'updated_at']
        else
          ['created_at', 'updated_at']

    div
      className: 'sort sort--beatmapset-discussions'
      div
        className: 'sort__items'
        span className: 'sort__item sort__item--title', osu.trans('sort._')
        for preset in presets
          button
            key: preset
            type: 'button'
            className: "sort__item sort__item--button #{if @currentSort() == preset then 'sort__item--active' else ''}"
            'data-sort-preset': preset
            onClick: @changeSort
            sortPresets[preset].text


  discussionPage: (discussion) =>
    return if !discussion.id?

    className = "#{bn}__discussion"
    visible = @props.currentDiscussions.byFilter[@props.currentFilter][@props.mode][discussion.id]?
    className += ' u-hide-by-height' unless visible

    if discussion.parent_id?
      parentDiscussion = _.find(@props.currentDiscussions.reviews, {id: discussion.parent_id})

    div
      key: discussion.id
      className: className
      el Discussion,
        discussion: discussion
        users: @props.users
        currentUser: @props.currentUser
        beatmapset: @props.beatmapset
        currentBeatmap: @props.currentBeatmap
        readPostIds: @props.readPostIds
        isTimelineVisible: @isTimelineVisible()
        visible: visible
        showDeleted: @props.showDeleted
        parentDiscussion: parentDiscussion


  changeSort: (e) =>
    targetPreset = e.currentTarget.dataset.sortPreset

    return if targetPreset == @currentSort()

    sort = osu.jsonClone @state.sort
    sort[@props.mode] = targetPreset

    @setState {sort}


  currentSort: =>
    @state.sort[@props.mode]


  expand: (e) =>
    e.preventDefault()
    $.publish 'beatmapDiscussionEntry:collapse', collapse: e.currentTarget.dataset.type


  hidden: (discussion) =>
    switch @props.currentFilter
      when 'mine' then discussion.user_id != @props.currentUser.id
      when 'resolved' then discussion.message_type == 'praise' || !discussion.resolved
      when 'pending' then discussion.message_type == 'praise' || discussion.resolved
      when 'praises' then discussion.message_type != 'praise'
      else false


  isTimelineVisible: =>
    @props.mode == 'timeline' && @currentSort() == 'timeline'


  sortedDiscussions: ->
    @props.currentDiscussions[@props.mode].slice().sort (a, b) =>
      mapperNoteCompare =
        # no sticky for timeline sort
        @currentSort() != 'timeline' &&
        # stick the mapper note
        'mapper_note' in [a.message_type, b.message_type] &&
        # but if both are mapper note, do base comparison
        a.message_type != b.message_type

      if mapperNoteCompare
        if a.message_type == 'mapper_note' then -1 else 1
      else
        sortPresets[@currentSort()].sort(a, b)


  timelineCircle: =>
    div
      'data-visibility': if !@isTimelineVisible() then 'hidden'
      className: "#{bn}__mode-circle #{bn}__mode-circle--active hidden-xs"


  toggleShowDeleted: =>
    $.publish 'beatmapDiscussionPost:toggleShowDeleted'
