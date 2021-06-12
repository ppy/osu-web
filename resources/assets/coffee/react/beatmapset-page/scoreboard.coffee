# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { ScoreTop } from './score-top'
import { ScoreboardTab } from './scoreboard-tab'
import { ScoreboardTable } from './scoreboard-table'
import ScoreboardMod from 'beatmapsets-show/scoreboard-mod'
import * as React from 'react'
import { div, h2, p } from 'react-dom-factories'
import { classWithModifiers } from 'utils/css'
el = React.createElement

export class Scoreboard extends React.PureComponent
  DEFAULT_MODS = ['NM', 'EZ', 'NF', 'HT', 'HR', 'SD', 'PF', 'DT', 'NC', 'HD', 'FL', 'SO']
  OSU_MODS = DEFAULT_MODS.concat('TD')
  MANIA_KEY_MODS = ['4K', '5K', '6K', '7K', '8K', '9K']
  MANIA_MODS = ['NM', 'EZ', 'NF', 'HT', 'HR', 'SD', 'PF', 'DT', 'NC', 'FI', 'HD', 'FL', 'MR']

  # FIXME: update to use utils/score's modeAttributesMap
  hitTypeMapping: =>
    # mapping of [displayed text, internal name] for each mode
    switch @props.beatmap.mode
      when 'osu'
        [['300', '300'], ['100', '100'], ['50', '50']]
      when 'taiko'
        [['great', '300'], ['good', '100']]
      when 'fruits'
        [['fruits', '300'], ['ticks', '100'], ['drp miss', 'katu']]
      when 'mania'
        [['max', 'geki'], ['300', '300'], ['200', 'katu'], ['100', '100'], ['50', '50']]

  constructor: (props) ->
    super props

    @state =
      loading: false

  setLoading: (_e, isLoading) =>
    @setState loading: isLoading

  componentDidMount: ->
    $.subscribe 'beatmapset:scoreboard:loading.beatmapsetPageScoreboard', @setLoading

  componentWillUnmount: ->
    $.unsubscribe '.beatmapsetPageScoreboard'

  render: ->
    userScoreFound = false

    className = 'beatmapset-scoreboard__main'
    className += ' beatmapset-scoreboard__main--loading' if @props.loading

    mods = if @props.beatmap.mode == 'mania'
      if @props.beatmap.convert
        _.concat(MANIA_MODS, MANIA_KEY_MODS)
      else
        MANIA_MODS

    else if @props.beatmap.mode == 'osu'
      OSU_MODS
    else
      DEFAULT_MODS

    div className: 'beatmapset-scoreboard',
      div className: 'page-tabs',
        for type in ['global', 'country', 'friend']
          el ScoreboardTab,
            key: type
            type: type
            active: @props.type == type

      if @props.isScoreable
        div
          className: classWithModifiers('beatmapset-scoreboard__mods', initial: @props.enabledMods.length == 0)
          for mod in mods
            el ScoreboardMod,
              key: mod
              mod: mod
              enabled: _.includes @props.enabledMods, mod

      div className: className,
        if @props.scores.length > 0
          div {},
            div className: 'beatmap-scoreboard-top',
              div className: 'beatmap-scoreboard-top__item',
                @scoreItem score: @props.scores[0], rank: 1

              if @props.userScore? && @props.scores[0].user.id != @props.userScore.user.id
                div className: 'beatmap-scoreboard-top__item',
                  @scoreItem score: @props.userScore, rank: @props.userScorePosition

            el ScoreboardTable,
              beatmap: @props.beatmap
              scores: @props.scores
              hitTypeMapping: @hitTypeMapping()
              scoreboardType: @props.type

        else if !@props.isScoreable
          p
            className: 'beatmapset-scoreboard__notice beatmapset-scoreboard__notice--no-scores'
            osu.trans 'beatmapsets.show.scoreboard.no_scores.unranked'

        else if currentUser.is_supporter || @props.type == 'global'
          translationKey = if @state.loading then 'loading' else @props.type

          p
            className: 'beatmapset-scoreboard__notice beatmapset-scoreboard__notice--no-scores'
            osu.trans "beatmapsets.show.scoreboard.no_scores.#{translationKey}"

        else
          div className: 'beatmapset-scoreboard__notice',
            p className: 'beatmapset-scoreboard__supporter-text', osu.trans 'beatmapsets.show.scoreboard.supporter-only'

            p
              className: 'beatmapset-scoreboard__supporter-text beatmapset-scoreboard__supporter-text--small'
              dangerouslySetInnerHTML:
                __html: osu.trans 'beatmapsets.show.scoreboard.supporter-link', link: laroute.route 'support-the-game'

  scoreItem: ({score, rank, itemClass, modifiers}) ->
    el ScoreTop,
      key: rank
      score: score
      position: rank
      beatmap: @props.beatmap
      modifiers: modifiers
      hitTypeMapping: @hitTypeMapping()
