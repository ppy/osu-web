# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import FlagCountry from 'flag-country'
import { route } from 'laroute'
import Mod from 'mod'
import PpValue from 'scores/pp-value'
import * as React from 'react'
import { a, div, span } from 'react-dom-factories'
import ScoreboardTime from 'scoreboard-time'
import { shouldShowPp } from 'utils/beatmap-helper'
import { classWithModifiers } from 'utils/css'

el = React.createElement
bn = 'beatmap-score-top'

export ScoreTop = (props) ->
  topClasses = (props.modifiers ? [])
    .map (m) -> "#{bn}--#{m}"
    .join ' '

  position = if props.position? then "##{props.position}" else '-'
  showPp = shouldShowPp(props.beatmap)

  div className: "#{bn} #{topClasses}",
    a
      className: "#{bn}__link-container"
      href: route('scores.show', mode: props.score.mode, score: props.score.best_id)

    div className: "#{bn}__section",
      div className: "#{bn}__wrapping-container #{bn}__wrapping-container--left",
        div className: "#{bn}__position",
          div
            className: "#{bn}__position-number"
            position
          div className: "score-rank score-rank--tiny score-rank--#{props.score.rank}"

        div className: "#{bn}__avatar",
          if props.score.user.is_deleted
            span className: 'avatar avatar--guest'
          else
            a
              href: route 'users.show', user: props.score.user.id
              className: "avatar u-hover"
              style:
                backgroundImage: osu.urlPresence(props.score.user.avatar_url)

        div className: "#{bn}__user-box",
          if props.score.user.is_deleted
            span
              className: "#{bn}__username"
              osu.trans('users.deleted')
          else
            a
              className: "#{bn}__username js-usercard u-hover"
              'data-user-id': props.score.user.id
              href: route 'users.show', user: props.score.user.id, mode: props.score.mode
              props.score.user.username

          div
            className: "#{bn}__achieved u-hover"
            dangerouslySetInnerHTML:
              __html: osu.trans('beatmapsets.show.scoreboard.achieved', when: osu.timeago(props.score.created_at))

          a
            className: 'u-hover'
            href: route 'rankings',
              mode: props.score.mode
              country: props.score.user.country_code
              type: 'performance'
            el FlagCountry,
              country: props.score.user.country
              modifiers: ['flat']

      div className: "#{bn}__wrapping-container #{bn}__wrapping-container--right",
        div className: "#{bn}__stats",
          div className: "#{bn}__stat",
            div className: "#{bn}__stat-header #{bn}__stat-header--wider",
              osu.trans 'beatmapsets.show.scoreboard.headers.score_total'
            div className: "#{bn}__stat-value #{bn}__stat-value--score",
              osu.formatNumber(props.score.score)

        div className: "#{bn}__stats",
          div className: "#{bn}__stat",
            div className: "#{bn}__stat-header #{bn}__stat-header--wider",
              osu.trans 'beatmapsets.show.scoreboard.headers.accuracy'
            div className: classWithModifiers("#{bn}__stat-value", perfect: props.score.accuracy == 1),
              "#{osu.formatNumber(props.score.accuracy * 100, 2)}%"

          div className: "#{bn}__stat",
            div className: "#{bn}__stat-header #{bn}__stat-header--wider",
              osu.trans 'beatmapsets.show.scoreboard.headers.combo'
            div className: classWithModifiers("#{bn}__stat-value", perfect: props.score.max_combo == props.beatmap.max_combo),
              "#{osu.formatNumber(props.score.max_combo)}x"

        div className: "#{bn}__stats #{bn}__stats--wrappable",
          for stat in props.hitTypeMapping
            div
              key: stat[0]
              className: "#{bn}__stat"
              div className: "#{bn}__stat-header",
                stat[0]
              div className: "#{bn}__stat-value #{bn}__stat-value--smaller",
                osu.formatNumber(props.score.statistics["count_#{stat[1]}"])

          div className: "#{bn}__stat",
            div className: "#{bn}__stat-header",
              osu.trans 'beatmapsets.show.scoreboard.headers.miss'
            div className: "#{bn}__stat-value #{bn}__stat-value--smaller",
              osu.formatNumber(props.score.statistics.count_miss)

          if showPp
            div className: "#{bn}__stat",
              div className: "#{bn}__stat-header",
                osu.trans 'beatmapsets.show.scoreboard.headers.pp'
              div className: "#{bn}__stat-value #{bn}__stat-value--smaller",
                el PpValue, score: props.score

          div className: "#{bn}__stat",
            div className: "#{bn}__stat-header",
              osu.trans 'beatmapsets.show.scoreboard.headers.time'
            div className: "#{bn}__stat-value #{bn}__stat-value--smaller u-hover",
              el ScoreboardTime,
                dateTime: props.score.created_at

          div className: "#{bn}__stat",
            div className: "#{bn}__stat-header #{bn}__stat-header--mods",
              osu.trans 'beatmapsets.show.scoreboard.headers.mods'
            div className: "#{bn}__stat-value #{bn}__stat-value--mods u-hover",
              el(Mod, key: mod, mod: mod) for mod in props.score.mods
