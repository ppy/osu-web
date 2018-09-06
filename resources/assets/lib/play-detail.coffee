###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

import { PlayDetailMenu } from 'play-detail-menu'
import { createElement as el, PureComponent } from 'react'
import { a, div, i, img, small, span } from 'react-dom-factories'

osu = window.osu

export PlayDetail = (props) ->
  score = props.score
  pp = score.best?.pp ? score.pp

  modsText =
    if score.mods.length
      " +#{(mod.shortName for mod in score.mods).join(',')} "
    else
      ' '

  classMods = if props.activated then ['menu-active'] else ['highlightable']

  div
    className: osu.classWithModifiers('detail-row', classMods)
    div
      className: 'detail-row__content'
      div
        className: 'detail-row__icon'
        div className: "badge-rank badge-rank--full badge-rank--#{score.rank}"

      div className: 'detail-row__detail',
        div
          className: 'detail-row__detail-column detail-row__detail-column--full'
          div
            className: 'detail-row__detail-row detail-row__detail-row--main'
            a
              href: score.beatmap.url
              className: 'detail-row__text-score detail-row__text-score--title'
              title: "#{score.beatmapset.artist} - #{score.beatmapset.title} "
              "#{score.beatmapset.title} [#{score.beatmap.version}]"
              ' '
              small
                className: 'detail-row__text-score detail-row__text-score--artist'
                score.beatmapset.artist
          div
            className: 'detail-row__detail-row detail-row__detail-row--bottom'
            span
              className: 'detail-row__text-score detail-row__text-score--time'
              dangerouslySetInnerHTML:
                __html: osu.timeago score.created_at
        div
          className: 'detail-row__detail-column detail-row__detail-column--score-data'
          div
            className: 'detail-row__score-data detail-row__score-data--mods'
            el Mods, mods: score.mods
          div
            className: 'detail-row__score-data detail-row__score-data--main'
            div
              className: 'detail-row__detail-row detail-row__detail-row--main'
              span
                className: 'detail-row__text-score detail-row__text-score--pp'
                title:
                  if score.weight
                    osu.trans 'users.show.extra.top_ranks.weighted_pp',
                      percentage: "#{Math.round(score.weight.percentage)}%"
                      pp: osu.trans('users.show.extra.top_ranks.pp', amount: Math.round(score.weight.pp)).toLocaleString()
                if pp > 0
                  osu.trans('users.show.extra.top_ranks.pp', amount: Math.round(pp).toLocaleString())
                else
                  span
                    title:
                      if score.beatmapset.status not in ['ranked', 'approved']
                        osu.trans('users.show.extra.top_ranks.not_ranked')
                    '-'
            div
              className: 'detail-row__score-details'
              div
                className: 'detail-row__text-score'
                osu.trans 'users.show.extra.historical.recent_plays.accuracy',
                  percentage: "#{(score.accuracy * 100).toFixed(2)}%"

    div
      className: 'detail-row__more'
      if score.replay
        el PlayDetailMenu,
          onHide: () -> props.onMenuActive?(active: false, index: props.index)
          onShow: () -> props.onMenuActive?(active: true, index: props.index)
          score: score
