# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { a, div, h2, h3, img, p, small, span } from 'react-dom-factories'
el = React.createElement

bn = 'beatmap-playcount'

export class BeatmapPlaycount extends React.PureComponent
  render: =>
    beatmap = @props.playcount.beatmap
    beatmapset = @props.playcount.beatmapset
    beatmapUrl = laroute.route 'beatmaps.show', beatmap: beatmap.id, mode: @props.currentMode

    div
      className: bn
      a
        href: beatmapUrl
        className: "#{bn}__cover"
        style:
          backgroundImage: osu.urlPresence(beatmapset.covers.list)
        div className: "#{bn}__cover-count",
          @renderPlaycountText()
      div
        className: "#{bn}__detail"
        div
          className: "#{bn}__info"
          div
            className: "#{bn}__info-row u-ellipsis-overflow"
            a
              className: "#{bn}__title"
              href: beatmapUrl
              "#{beatmapset.title} [#{beatmap.version}] "
              span
                className: "#{bn}__title-artist"
                osu.trans('users.show.extra.beatmaps.by_artist', artist: beatmapset.artist)
          div
            className: "#{bn}__info-row u-ellipsis-overflow"
            span
              className: "#{bn}__artist"
              dangerouslySetInnerHTML:
                __html: osu.trans('users.show.extra.beatmaps.by_artist', artist: "<strong>#{_.escape(beatmapset.artist)}</strong>")
            ' ' # separator for overflow tooltip
            span
              className: "#{bn}__mapper"
              dangerouslySetInnerHTML:
                __html: osu.trans 'beatmapsets.show.details.mapped_by',
                  mapper: laroute.link_to_route 'users.show',
                    beatmapset.creator
                    { user: beatmapset.user_id }
                    class: "#{bn}__mapper-link js-usercard"
                    'data-user-id': beatmapset.user_id
        div
          className: "#{bn}__detail-count"
          @renderPlaycountText()


  renderPlaycountText: =>
    div
      title: osu.trans('users.show.extra.historical.most_played.count')
      className: "#{bn}__count"
      span
        className: "#{bn}__count-icon"
        span className: 'fas fa-play'
      osu.formatNumber(@props.playcount.count)
