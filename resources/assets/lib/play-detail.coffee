# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import Mod from 'mod'
import { PlayDetailMenu } from 'play-detail-menu'
import { createElement as el, PureComponent } from 'react'
import * as React from 'react'
import { a, button, div, i, img, small, span } from 'react-dom-factories'
import PpValue from 'scores/pp-value'
import { getArtist, getTitle, shouldShowPp } from 'utils/beatmap-helper'
import { hasMenu } from 'utils/score-helper'

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

    hasPp = score.beatmapset.status in ['ranked', 'approved']
    validPp = hasPp && score.pp?

    div
      className: blockClass
      div className: "#{bn}__group #{bn}__group--top",
        div
          className: "#{bn}__icon #{bn}__icon--main"
          div className: "score-rank score-rank--full score-rank--#{score.rank}"

        div className: "#{bn}__detail",
          a
            href: laroute.route('beatmaps.show', beatmap: score.beatmap.id, mode: score.mode)
            className: "#{bn}__title u-ellipsis-overflow"
            getTitle(score.beatmapset)
            ' '
            small
              className: "#{bn}__artist"
              osu.trans('users.show.extra.beatmaps.by_artist', artist: getArtist(score.beatmapset))
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
                  if score.pp?
                    "#{osu.formatNumber(Math.round(score.weight.pp))}pp"
            if score.weight?
              div
                className: "#{bn}__pp-weight"
                osu.trans 'users.show.extra.top_ranks.pp_weight',
                  percentage: "#{osu.formatNumber(Math.round(score.weight.percentage))}%"
        div
          className: "#{bn}__score-detail #{bn}__score-detail--mods"
          el(Mod, key: mod, mod: mod) for mod in score.mods

        div
          className: "#{bn}__pp"
          if shouldShowPp(score.beatmap)
            el React.Fragment, null,
              el PpValue,
                score: score
                suffix: span(className: "#{bn}__pp-unit", 'pp')
          else
            span
              title: osu.trans('users.show.extra.top_ranks.not_ranked')
              '-'

        div
          className: "#{bn}__more"
          if hasMenu(score)
            el PlayDetailMenu,
              { score }


  toggleCompact: =>
    @setState compact: !@state.compact
