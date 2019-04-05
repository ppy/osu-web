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

import * as React from 'react'
import { a, div, h2, h3, img, p, small, span } from 'react-dom-factories'
el = React.createElement

bn = 'beatmap-playcount'

export class BeatmapPlaycount extends React.PureComponent
  render: =>
    beatmap = @props.playcount.beatmap
    beatmapset = @props.playcount.beatmapset
    beatmapsetUrl = laroute.route 'beatmaps.show', beatmap: beatmap.id

    div
      className: bn
      a
        href: beatmapsetUrl
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
              href: beatmapsetUrl
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
