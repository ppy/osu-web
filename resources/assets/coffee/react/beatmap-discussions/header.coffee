# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import BeatmapList from 'beatmapsets-show/beatmap-list'
import { BigButton } from 'big-button'
import { Nominations } from './nominations'
import { Subscribe } from './subscribe'
import { UserFilter } from './user-filter'
import { BeatmapBasicStats } from 'beatmap-basic-stats'
import { BeatmapsetMapping } from 'beatmapset-mapping'
import HeaderV4 from 'header-v4'
import { deletedUser } from 'models/user'
import PlaymodeTabs from 'playmode-tabs'
import * as React from 'react'
import { a, div, h1, h2, p, span } from 'react-dom-factories'
import { StringWithComponent } from 'string-with-component'
import { UserLink } from 'user-link'
import { getArtist, getTitle } from 'utils/beatmap-helper'
import { showVisual } from 'utils/beatmapset-helper'
import Chart from 'beatmap-discussions/chart'
el = React.createElement

export class Header extends React.PureComponent
  render: =>
    el React.Fragment, null,
      el HeaderV4,
        theme: 'beatmapsets'
        titleAppend: el PlaymodeTabs,
          beatmaps: @props.beatmaps
          counts: @props.currentDiscussions.countsByPlaymode
          currentMode: @props.currentBeatmap.mode

      div
        className: 'osu-page'
        @headerTop()

      div
        className: 'osu-page osu-page--small'
        @headerBottom()


  headerBottom: =>
    bn = 'beatmap-discussions-header-bottom'

    div className: bn,
      div className: "#{bn}__content #{bn}__content--details",
        div className: "#{bn}__details #{bn}__details--full",
          el BeatmapsetMapping,
            beatmapset: @props.beatmapset
            user: @props.users[@props.beatmapset.user_id]

        div className: "#{bn}__details",
          el Subscribe, beatmapset: @props.beatmapset

        div className: "#{bn}__details",
          el BigButton,
            modifiers: ['full']
            text: osu.trans('beatmaps.discussions.beatmap_information')
            icon: 'fas fa-info'
            props:
              href: laroute.route('beatmapsets.show', beatmapset: @props.beatmapset.id)

      div className: "#{bn}__content #{bn}__content--nomination",
        el Nominations,
          beatmapset: @props.beatmapset
          currentDiscussions: @props.currentDiscussions
          currentUser: @props.currentUser
          discussions: @props.discussions
          events: @props.events
          users: @props.users


  headerTop: =>
    bn = 'beatmap-discussions-header-top'

    div
      className: bn

      div
        className: "#{bn}__content"
        style:
          backgroundImage: osu.urlPresence(@props.beatmapset.covers.cover) if showVisual(@props.beatmapset)

        a
          className: "#{bn}__title-container"
          href: laroute.route('beatmapsets.show', beatmapset: @props.beatmapset.id)
          h1
            className: "#{bn}__title"
            getTitle(@props.beatmapset)
            if @props.beatmapset.nsfw
              span className: 'nsfw-badge', osu.trans('beatmapsets.nsfw_badge.label')
          h2
            className: "#{bn}__title #{bn}__title--artist"
            getArtist(@props.beatmapset)

        div
          className: "#{bn}__filters"

          div
            className: "#{bn}__filter-group"
            el BeatmapList,
              currentBeatmap: @props.currentBeatmap
              currentDiscussions: @props.currentDiscussions
              beatmaps: @props.beatmaps.get(@props.currentBeatmap.mode)

          div
            className: "#{bn}__filter-group #{bn}__filter-group--stats"
            el UserFilter,
              ownerId: @props.beatmapset.user_id
              selectedUser: if @props.selectedUserId? then @props.users[@props.selectedUserId] else null
              users: @props.discussionStarters

            div
              className: "#{bn}__stats"
              @stats()

        div className: 'u-relative',
          el Chart,
            discussions: @props.currentDiscussions.byFilter[@props.currentFilter].timeline
            duration: @props.currentBeatmap.total_length * 1000

          div className: "#{bn}__beatmap-stats",
            div className: "#{bn}__guest",
              if @props.currentBeatmap.user_id != @props.beatmapset.user_id
                span null,
                  el StringWithComponent,
                    mappings:
                      ':user': el(UserLink, key: 'user', user: @props.users[@props.currentBeatmap.user_id] ? deletedUser)
                    pattern: osu.trans('beatmaps.discussions.guest')
            el BeatmapBasicStats, beatmap: @props.currentBeatmap


  setFilter: (e) =>
    e.preventDefault()
    $.publish 'beatmapsetDiscussions:update', filter: e.currentTarget.dataset.type


  stats: =>
    bn = 'counter-box'

    for type in ['mine', 'mapperNotes', 'resolved', 'pending', 'praises', 'deleted', 'total']
      continue if type == 'deleted' && !@props.currentUser.is_admin

      topClasses = "#{bn} #{bn}--beatmap-discussions #{bn}--#{_.kebabCase(type)}"
      topClasses += ' js-active' if @props.mode != 'events' && @props.currentFilter == type

      total = 0
      for own _mode, discussions of @props.currentDiscussions.byFilter[type]
        total += _.size(discussions)

      a
        key: type
        href: BeatmapDiscussionHelper.url
          filter: type
          beatmapsetId: @props.beatmapset.id
          beatmapId: @props.currentBeatmap.id
          mode: @props.mode
        className: topClasses
        'data-type': type
        onClick: @setFilter

        div
          className: "#{bn}__content"
          div
            className: "#{bn}__title"
            osu.trans("beatmaps.discussions.stats.#{_.snakeCase(type)}")
          div
            className: "#{bn}__count"
            total

        div className: "#{bn}__line"
