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

import { Mods } from 'mods'
import { PlayDetailMenu } from 'play-detail-menu'
import { createElement as el, PureComponent } from 'react'
import * as React from 'react'
import { a, button, div, i, img, small, span } from 'react-dom-factories'
import { ScoreHelper } from 'score-helper'

osu = window.osu
bn = 'play-detail'

export class PlayDetail extends PureComponent
  constructor: (props) ->
    super props

    @state = compact: true


  render: =>
    score = @props.score

    blockClass = bn
    if @props.activated
      blockClass += " #{bn}--active"
    else
      blockClass += " #{bn}--highlightable"
    blockClass += " #{bn}--compact" if @state.compact

    div
      className: blockClass
      div className: "#{bn}__group #{bn}__group--top",
        div
          className: "#{bn}__icon #{bn}__icon--main"
          div className: "score-rank score-rank--full score-rank--#{score.rank}"

        div className: "#{bn}__detail",
          a
            href: score.beatmap.url
            className: "#{bn}__title u-ellipsis-overflow"
            score.beatmapset.title
            ' '
            small
              className: "#{bn}__artist"
              osu.trans('users.show.extra.beatmaps.by_artist', artist: score.beatmapset.artist)
          div
            className: "#{bn}__beatmap-and-time"
            span
              className: "#{bn}__beatmap"
              score.beatmap.version
            span
              className: "#{bn}__time"
              dangerouslySetInnerHTML:
                __html: osu.timeago score.created_at

        button
          className: "#{bn}__compact-toggle"
          onClick: @toggleCompact
          span className: "fas #{if @state.compact then 'fa-chevron-down' else 'fa-chevron-up'}"

      div className: "#{bn}__group #{bn}__group--bottom",
        div className: "#{bn}__score-detail #{bn}__score-detail--score",
          div
            className: "#{bn}__icon #{bn}__icon--extra"
            div className: "score-rank score-rank--full score-rank--#{score.rank}"
          div className: "#{bn}__score-detail-top-right",
            div
              className: "#{bn}__accuracy-and-weighted-pp"
              span
                className: "#{bn}__accuracy"
                "#{osu.formatNumber(score.accuracy * 100, 2)}%"
              if score.weight?
                span
                  className: "#{bn}__weighted-pp"
                  osu.formatNumber(Math.round(score.weight.pp))
                  'pp'
            if score.weight?
              div
                className: "#{bn}__pp-weight"
                osu.trans 'users.show.extra.top_ranks.pp_weight',
                  percentage: "#{osu.formatNumber(Math.round(score.weight.percentage))}%"
        div
          className: "#{bn}__score-detail #{bn}__score-detail--mods"
          el Mods, mods: score.mods, modifiers: ['profile-page']

        div
          className: "#{bn}__pp"
          if score.pp > 0
            span null,
              osu.formatNumber(Math.round(score.pp))
              span className: "#{bn}__pp-unit", 'pp'
          else
            span
              title:
                if score.beatmapset.status not in ['ranked', 'approved']
                  osu.trans('users.show.extra.top_ranks.not_ranked')
              '-'

        div
          className: "#{bn}__more"
          if ScoreHelper.hasMenu(score)
            el PlayDetailMenu,
              { score }


  toggleCompact: =>
    @setState compact: !@state.compact
