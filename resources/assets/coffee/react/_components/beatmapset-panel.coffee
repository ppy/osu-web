# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { BeatmapIcon } from 'beatmap-icon'
import { Img2x } from 'img2x'
import * as React from 'react'
import { a, button, div, i, span, strong } from 'react-dom-factories'
import { StringWithComponent } from 'string-with-component'
import OsuUrlHelper from 'osu-url-helper'
import * as BeatmapHelper from 'utils/beatmap-helper'
el = React.createElement

export class BeatmapsetPanel extends React.PureComponent
  hideImage: (e) ->
    # hides img elements that have errored (hides native browser broken-image icons)
    e.currentTarget.style.display = 'none'


  render: =>
    # this is actually "beatmapset"
    beatmapset = @props.beatmap

    showHypeCounts = beatmapset.hype?
    if showHypeCounts
      currentHype = osu.formatNumber(beatmapset.hype?.current)
      requiredHype = osu.formatNumber(beatmapset.hype?.required)

      if beatmapset.nominations_summary?
        currentNominations = osu.formatNumber beatmapset.nominations_summary.current
        requiredNominations = osu.formatNumber beatmapset.nominations_summary.required
      else if beatmapset.nominations?
        if beatmapset.nominations.legacy_mode
          currentNominations = osu.formatNumber beatmapset.nominations.current
          requiredNominations = osu.formatNumber beatmapset.nominations.required
        else
          currentNominations = osu.formatNumber _.sum(_.values(beatmapset.nominations?.current))
          requiredNominations = osu.formatNumber _.sum(_.values(beatmapset.nominations?.required))

    playCount = osu.formatNumber(beatmapset.play_count)

    favouriteCount = osu.formatNumber(beatmapset.favourite_count)

    # arbitrary number
    maxDisplayedDifficulty = 10

    condenseDifficulties = beatmapset.beatmaps.length > maxDisplayedDifficulty

    groupedBeatmaps = BeatmapHelper.group beatmapset.beatmaps

    difficulties =
      for mode in BeatmapHelper.modes
        beatmaps = groupedBeatmaps[mode]

        continue unless beatmaps?

        if condenseDifficulties
          [
            el BeatmapIcon, key: "#{mode}-icon", beatmap: _.last(beatmaps), showTitle: false
            span
              className: 'beatmapset-panel__difficulty-count'
              key: "#{mode}-count", beatmaps.length
          ]
        else
          for b in beatmaps
            div
              className: 'beatmapset-panel__difficulty-icon'
              key: b.id
              el BeatmapIcon, beatmap: b

    div
      className: 'beatmapset-panel js-audio--player'
      'data-audio-url': beatmapset.preview_url
      div className: 'beatmapset-panel__panel',
        a
          href: laroute.route('beatmapsets.show', beatmapset: beatmapset.id)
          className: 'beatmapset-panel__header',
          el Img2x,
            className: 'beatmapset-panel__image'
            onError: @hideImage
            src: beatmapset.covers.card
          div className: 'beatmapset-panel__image-overlay'
          div className: 'beatmapset-panel__status-container',
            if beatmapset.video
              div className: 'beatmapset-panel__extra-icon',
                i className: 'fas fa-film fa-fw'
            if beatmapset.storyboard
              div className: 'beatmapset-panel__extra-icon',
                i className: 'fas fa-image fa-fw'
            div className: 'beatmapset-status', osu.trans("beatmapsets.show.status.#{beatmapset.status}")

          div className: 'beatmapset-panel__title-artist-box',
            div className: 'u-ellipsis-overflow beatmapset-panel__header-text beatmapset-panel__header-text--title',
              BeatmapHelper.getTitle(beatmapset)
            div className: 'u-ellipsis-overflow beatmapset-panel__header-text',
              BeatmapHelper.getArtist(beatmapset)

          div className: 'beatmapset-panel__counts-box',
            if showHypeCounts
              div null,
                div className: 'beatmapset-panel__count', title: osu.trans('beatmaps.hype.required_text', {current: currentHype, required: requiredHype}),
                  span className: 'beatmapset-panel__count-number', currentHype
                  i className: 'fas fa-bullhorn fa-fw'
                div className: 'beatmapset-panel__count', title: osu.trans('beatmaps.nominations.required_text', {current: currentNominations, required: requiredNominations}),
                  span className: 'beatmapset-panel__count-number', currentNominations
                  i className: 'fas fa-thumbs-up fa-fw'

            div null,
              div className: 'beatmapset-panel__count', title: osu.trans('beatmaps.panel.playcount', count: playCount),
                span className: 'beatmapset-panel__count-number', playCount
                i className: 'fas fa-fw fa-play-circle'
              div className: 'beatmapset-panel__count', title: osu.trans('beatmaps.panel.favourites', count: favouriteCount),
                span className: 'beatmapset-panel__count-number', favouriteCount
                i className: 'fas fa-fw fa-heart'

          div className: 'beatmapset-panel__preview-bar'

        div className: 'beatmapset-panel__content',
          div className: 'beatmapset-panel__row',
            div className: 'beatmapset-panel__mapper-source-box',
              div
                className: 'u-ellipsis-overflow'
                el StringWithComponent,
                  pattern: osu.trans 'beatmapsets.show.details.mapped_by'
                  mappings:
                    ':mapper':
                      a
                        key: 'mapper'
                        href: laroute.route('users.show', user: beatmapset.user_id)
                        className: 'js-usercard'
                        'data-user-id': beatmapset.user_id
                        strong null, beatmapset.creator
              div
                className: 'u-ellipsis-overflow'
                if beatmapset.status in ['graveyard', 'wip', 'pending']
                  span dangerouslySetInnerHTML: __html:
                    osu.trans 'beatmapsets.show.details.updated_timeago',
                      timeago: osu.timeago(beatmapset.last_updated)
                else
                  beatmapset.source

            div className: 'beatmapset-panel__icons-box',
              @renderDownloadLink()

          div className: 'beatmapset-panel__difficulties', difficulties
      button
        type: 'button'
        className: 'beatmapset-panel__play js-audio--play'
      div className: 'beatmapset-panel__shadow'


  renderDownloadLink: =>
    return null unless currentUser.id?

    beatmapset = @props.beatmap

    if beatmapset.availability.download_disabled
      return div
        title: osu.trans('beatmapsets.availability.disabled')
        className: 'beatmapset-panel__icon beatmapset-panel__icon--disabled'
        i className: 'fas fa-lg fa-download'

    type = currentUser.user_preferences.beatmapset_download
    type = 'all' if type == 'direct' && !currentUser.is_supporter

    switch type
      when 'direct'
        url = OsuUrlHelper.beatmapsetDownloadDirect beatmapset.id
        title = osu.trans 'beatmapsets.panel.download.direct'
      else
        if beatmapset.video
          switch type
            when 'no_video'
              url = laroute.route 'beatmapsets.download', beatmapset: beatmapset.id, noVideo: 1
              title = osu.trans 'beatmapsets.panel.download.no_video'
            else
              url = laroute.route 'beatmapsets.download', beatmapset: beatmapset.id
              title = osu.trans 'beatmapsets.panel.download.video'
        else
          url = laroute.route 'beatmapsets.download', beatmapset: beatmapset.id
          title = osu.trans 'beatmapsets.panel.download.all'

    a
      href: url
      title: title
      className: 'beatmapset-panel__icon js-beatmapset-download-link'
      'data-turbolinks': 'false'
      i className: 'fas fa-lg fa-download'
