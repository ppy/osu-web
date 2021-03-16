# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { BeatmapIcon } from 'beatmap-icon'
import { Img2x } from 'img2x'
import * as React from 'react'
import { a, button, div, i, span, strong } from 'react-dom-factories'
import { StringWithComponent } from 'string-with-component'
import OsuUrlHelper from 'osu-url-helper'
import TimeWithTooltip from 'time-with-tooltip'
import * as BeatmapHelper from 'utils/beatmap-helper'
import { showVisual, toggleFavourite } from 'utils/beatmapset-helper'
import { Observer } from 'mobx-react'
el = React.createElement

export class BeatmapsetPanel extends React.PureComponent
  hideImage: (e) ->
    # hides img elements that have errored (hides native browser broken-image icons)
    e.currentTarget.style.display = 'none'


  render: =>
    el Observer, null, @renderReal


  renderReal: =>
    beatmapset = @props.beatmapset

    @showVisual = showVisual(beatmapset)
    showHypeCounts = beatmapset.hype?
    nominations = @getNominations() if showHypeCounts
    downloadLink = @getDownloadLink()
    groupedBeatmaps = BeatmapHelper.group beatmapset.beatmaps
    url = laroute.route('beatmapsets.show', beatmapset: beatmapset.id)
    displayDateAttribute = if beatmapset.ranked > 0 then 'ranked_date' else 'last_updated'

    div
      className: "beatmapset-panel #{if @showVisual then 'js-audio--player' else ''}"
      'data-audio-url': beatmapset.preview_url
      a
        href: url
        className: 'beatmapset-panel__cover-container',
        div className: 'beatmapset-panel__cover beatmapset-panel__cover--default'
        if @showVisual
          el Img2x,
            className: 'beatmapset-panel__cover'
            onError: @hideImage
            src: beatmapset.covers.card
      div className: 'beatmapset-panel__content',
        div className: 'beatmapset-panel__play-container',
          div className: 'beatmapset-panel__extra-icons',
            if beatmapset.video
              div
                className: 'beatmapset-panel__extra-icon'
                title: osu.trans('beatmapsets.show.info.video')
                i className: 'fas fa-film'
            if beatmapset.storyboard
              div
                className: 'beatmapset-panel__extra-icon'
                title: osu.trans('beatmapsets.show.info.storyboard')
                i className: 'fas fa-image'
          if @showVisual
            button
              type: 'button'
              className: 'beatmapset-panel__play js-audio--play'
        div className: 'beatmapset-panel__info',
          div className: 'beatmapset-panel__info-row beatmapset-panel__info-row--title',
            a
              className: 'beatmapset-panel__main-link u-ellipsis-overflow'
              href: url
              BeatmapHelper.getTitle(beatmapset)
            if beatmapset.nsfw
              span className: 'nsfw-badge nsfw-badge--panel', osu.trans('beatmapsets.nsfw_badge.label')
          div className: 'beatmapset-panel__info-row beatmapset-panel__info-row--artist',
            a
              className: 'beatmapset-panel__main-link u-ellipsis-overflow'
              href: url
              osu.trans('beatmapsets.show.details.by_artist', artist: BeatmapHelper.getArtist(beatmapset))
          div className: 'beatmapset-panel__info-row beatmapset-panel__info-row--mapper',
            div
              className: 'u-ellipsis-overflow'
              el StringWithComponent,
                pattern: osu.trans 'beatmapsets.show.details.mapped_by'
                mappings:
                  ':mapper':
                    a
                      key: 'mapper'
                      href: laroute.route('users.show', user: beatmapset.user_id)
                      className: 'beatmapset-panel__mapper-link u-hover js-usercard'
                      'data-user-id': beatmapset.user_id
                      beatmapset.creator

          div className: 'beatmapset-panel__info-row beatmapset-panel__info-row--stats',
            if showHypeCounts
              @renderStatsItem
                title: osu.trans 'beatmaps.hype.required_text',
                  current: osu.formatNumber(beatmapset.hype.current)
                  required: osu.formatNumber(beatmapset.hype.required)
                icon: 'fas fa-bullhorn'
                value: beatmapset.hype.current

            if showHypeCounts
              @renderStatsItem
                title: osu.trans 'beatmaps.nominations.required_text',
                  current: osu.formatNumber(nominations.current)
                  required: osu.formatNumber(nominations.required)
                icon: 'fas fa-thumbs-up'
                value: nominations.current

            @renderStatsItem
              title: osu.trans('beatmaps.panel.playcount', count: osu.formatNumber(beatmapset.play_count))
              icon: 'fas fa-play-circle'
              value: beatmapset.play_count

            @renderStatsItem
              title: osu.trans('beatmaps.panel.favourites', count: osu.formatNumber(beatmapset.favourite_count))
              icon: 'fas fa-heart'
              value: beatmapset.favourite_count

            div className: 'beatmapset-panel__stats-item',
              span className: 'beatmapset-panel__stats-item-icon',
                i className: 'fas fa-fw fa-check-circle'
              el TimeWithTooltip, dateTime: beatmapset[displayDateAttribute], format: 'L'

          div className: 'beatmapset-panel__info-row',
            div
              className: 'beatmapset-status beatmapset-status--panel'
              style:
                '--bg': "var(--beatmapset-#{beatmapset.status}-bg)"
                '--colour': "var(--beatmapset-#{beatmapset.status}-colour)"
              osu.trans("beatmapsets.show.status.#{beatmapset.status}")
            div className: 'beatmapset-panel__beatmaps-all',
              for mode in BeatmapHelper.modes
                beatmaps = groupedBeatmaps[mode]

                continue unless beatmaps?

                div
                  className: 'beatmapset-panel__beatmaps'
                  key: mode
                  div className: 'beatmapset-panel__beatmap-icon',
                    i className: "fal fa-extra-mode-#{mode}"
                  for beatmap in beatmaps
                    div
                      className: 'beatmapset-panel__beatmap'
                      style:
                        '--bg': "var(--diff-#{BeatmapHelper.getDiffRating(beatmap.difficulty_rating)})"
                      key: "beatmap-#{beatmap.id}"

        div className: 'beatmapset-panel__menu-container',
          div className: 'beatmapset-panel__menu',
            button
              type: 'button'
              className: 'beatmapset-panel__menu-item js-login-required--click'
              onClick: @toggleFavourite
              span className: 'fas fa-heart'

            a
              href: laroute.route('beatmapsets.discussion', beatmapset: beatmapset.id)
              className: 'beatmapset-panel__menu-item'
              span className: 'fas fa-comment-alt'

            if downloadLink.url?
              a
                href: downloadLink.url
                title: downloadLink.title
                className: 'beatmapset-panel__menu-item'
                'data-turbolinks': 'false'
                span className: 'fas fa-file-download'
            else
              span
                title: downloadLink.title
                className: 'beatmapset-panel__menu-item beatmapset-panel__menu-item--disabled'
                span className: 'fas fa-file-download'


  getDownloadLink: =>
    if !currentUser.id?
      return title: osu.trans('beatmapsets.show.details.logged-out')

    beatmapset = @props.beatmapset

    if beatmapset.availability.download_disabled
      return title: osu.trans('beatmapsets.availability.disabled')

    type = currentUser.user_preferences.beatmapset_download
    type = 'all' if type == 'direct' && !currentUser.is_supporter

    if type == 'direct'
        url = OsuUrlHelper.beatmapsetDownloadDirect beatmapset.id
        title = osu.trans 'beatmapsets.panel.download.direct'
    else
      if beatmapset.video
        if type == 'no_video'
          url = laroute.route 'beatmapsets.download', beatmapset: beatmapset.id, noVideo: 1
          title = osu.trans 'beatmapsets.panel.download.no_video'
        else
          url = laroute.route 'beatmapsets.download', beatmapset: beatmapset.id
          title = osu.trans 'beatmapsets.panel.download.video'
      else
        url = laroute.route 'beatmapsets.download', beatmapset: beatmapset.id
        title = osu.trans 'beatmapsets.panel.download.all'

    { url, title }


  renderStatsItem: ({ icon, title, value }) ->
    div className: 'beatmapset-panel__stats-item u-hover', title: title,
      span className: 'beatmapset-panel__stats-item-icon',
        i className: icon
      span null, osu.formatNumberSuffixed(value, 0)


  getNominations: =>
    if @props.beatmapset.nominations_summary?
      @props.beatmapset.nominations_summary
    else if @props.beatmapset.nominations?
      if @props.beatmapset.nominations.legacy_mode
        @props.beatmapset.nominations
      else
        current: _.sum(_.values(@props.beatmapset.nominations?.current))
        required: _.sum(_.values(@props.beatmapset.nominations?.required))


  toggleFavourite: =>
    toggleFavourite @props.beatmapset
