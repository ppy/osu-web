# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import headerLinks from 'beatmapsets-show/header-links'
import BeatmapBasicStats from 'components/beatmap-basic-stats'
import BeatmapsetCover from 'components/beatmapset-cover'
import BeatmapsetMapping from 'components/beatmapset-mapping'
import BigButton from 'components/big-button'
import HeaderV4 from 'components/header-v4'
import PlaymodeTabs from 'components/playmode-tabs'
import StringWithComponent from 'components/string-with-component'
import { UserLink } from 'components/user-link'
import { gameModes } from 'interfaces/game-mode'
import { route } from 'laroute'
import { deletedUser } from 'models/user'
import * as React from 'react'
import { a, div, h1, h2, p, span } from 'react-dom-factories'
import { getArtist, getTitle } from 'utils/beatmap-helper'
import { trans } from 'utils/lang'
import BeatmapList from './beatmap-list'
import Chart from './chart'
import { Nominations } from './nominations'
import { Subscribe } from './subscribe'
import { UserFilter } from './user-filter'
import { wikiUrl } from 'utils/url'


el = React.createElement

export class Header extends React.PureComponent
  render: =>
    el React.Fragment, null,
      el HeaderV4,
        links: headerLinks 'discussions', @props.beatmapset
        linksAppend: el PlaymodeTabs,
          currentMode: @props.currentBeatmap.mode
          entries: gameModes.map (mode) =>
            counts: @props.currentDiscussions.countsByPlaymode[mode]
            disabled: @props.beatmaps.get(mode).length == 0
            mode: mode
          modifiers: 'beatmapset'
          onClick: @onClickMode
        theme: 'beatmapset'

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
            href: route('beatmapsets.show', beatmapset: @props.beatmapset.id)
            icon: 'fas fa-info'
            modifiers: 'full'
            text: trans('beatmaps.discussions.beatmap_information')

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

        div className: "#{bn}__cover",
          el BeatmapsetCover,
            beatmapset: @props.beatmapset
            modifiers: 'full'
            size: 'cover'

        div
          className: "#{bn}__title-container"
          h1
            className: "#{bn}__title"
            a
              href: route('beatmapsets.show', beatmapset: @props.beatmapset.id)
              className: 'link link--white link--no-underline'
              getTitle(@props.beatmapset)
            if @props.beatmapset.nsfw
              span className: 'beatmapset-badge beatmapset-badge--nsfw', trans('beatmapsets.nsfw_badge.label')
            if @props.beatmapset.spotlight
              a
                className: 'beatmapset-badge beatmapset-badge--spotlight'
                href: wikiUrl('Beatmap_Spotlights')
                trans('beatmapsets.spotlight_badge.label')
          h2
            className: "#{bn}__title #{bn}__title--artist"
            getArtist(@props.beatmapset)
            if @props.beatmapset.track_id?
              a
                className: 'beatmapset-badge beatmapset-badge--featured-artist'
                href: route 'tracks.show', @props.beatmapset.track_id
                trans('beatmapsets.featured_artist_badge.label')

        div
          className: "#{bn}__filters"

          div
            className: "#{bn}__filter-group"
            el BeatmapList,
              beatmaps: @props.beatmaps.get(@props.currentBeatmap.mode)
              currentBeatmap: @props.currentBeatmap
              createLink: @createLink
              getCount: @getCount
              onSelectBeatmap: @onSelectBeatmap

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
                      user: el(UserLink, user: @props.users[@props.currentBeatmap.user_id] ? deletedUser)
                    pattern: trans('beatmaps.discussions.guest')
            el BeatmapBasicStats, beatmap: @props.currentBeatmap, beatmapset: @props.beatmapset


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
            trans("beatmaps.discussions.stats.#{_.snakeCase(type)}")
          div
            className: "#{bn}__count"
            total

        div className: "#{bn}__line"


  createLink: (beatmap) =>
    BeatmapDiscussionHelper.url beatmap: beatmap


  getCount: (beatmap) =>
    if beatmap.deleted_at? then undefined else @props.currentDiscussions.countsByBeatmap[beatmap.id]


  onClickMode: (e, mode) =>
    e.preventDefault()
    $.publish 'playmode:set', [{ mode }]


  onSelectBeatmap: (beatmapId) =>
    $.publish 'beatmapsetDiscussions:update',
      beatmapId: beatmapId
      mode: 'timeline'
