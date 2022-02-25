# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { BeatmapBasicStats } from 'components/beatmap-basic-stats'
import core from 'osu-core-singleton'
import * as React from 'react'
import { button, div, span, table, tbody, td, th, tr, i } from 'react-dom-factories'
import { nextVal } from 'utils/seq'

el = React.createElement

export class Stats extends React.Component
  constructor: (props) ->
    super props

    @disposers = new Set


  componentDidMount: =>
    @_renderChart()


  componentWillUnmount: =>
    @disposers.forEach (disposer) => disposer?()


  componentDidUpdate: =>
    @_renderChart()


  render: =>
    ratingsPositive = 0
    ratingsNegative = 0

    for rating, count of @props.beatmapset.ratings
      ratingsNegative += count if rating >= 1 && rating <= 5
      ratingsPositive += count if rating >= 6 && rating <= 10

    ratingsAll = ratingsPositive + ratingsNegative
    stats = switch @props.beatmap.mode
              when 'mania' then ['cs', 'drain', 'accuracy', 'stars']
              when 'taiko' then ['drain', 'accuracy', 'stars']
              else ['cs', 'drain', 'accuracy', 'ar', 'stars']

    div className: 'beatmapset-stats',
      button
        type: 'button'
        className: "beatmapset-stats__row beatmapsets-stats__row beatmapset-stats__row--preview js-audio--play js-audio--player"
        'data-audio-url': @props.beatmapset.preview_url
        span className: 'play-button'
        div className: 'beatmapset-stats__elapsed-bar'

      div className: 'beatmapset-stats__row beatmapset-stats__row--basic',
        el BeatmapBasicStats, beatmap: @props.beatmap, beatmapset: @props.beatmapset

      div className: 'beatmapset-stats__row beatmapset-stats__row--advanced',
        table className: 'beatmap-stats-table',
          tbody null,
            for stat in stats
              value =
                if stat == 'stars'
                  @props.beatmap.difficulty_rating
                else
                  @props.beatmap[stat]

              valueText =
                if stat == 'stars'
                  osu.formatNumber(value, 2)
                else
                  osu.formatNumber(value)

              if @props.beatmap.mode == 'mania' && stat == 'cs'
                stat += '-mania'

              tr
                key: stat
                th className: 'beatmap-stats-table__label', osu.trans "beatmapsets.show.stats.#{stat}"
                td className: 'beatmap-stats-table__bar',
                  div className: "bar bar--beatmap-stats bar--beatmap-stats-#{stat}",
                    div
                      className: 'bar__fill'
                      style:
                        width: "#{10 * Math.min 10, value}%"
                td className: 'beatmap-stats-table__value', valueText

      if @props.beatmapset.is_scoreable
        div className: 'beatmapset-stats__row beatmapset-stats__row--rating',
          div className: 'beatmapset-stats__rating-header', osu.trans 'beatmapsets.show.stats.user-rating'
          div className: 'bar--beatmap-rating',
            div
              className: 'bar__fill'
              style:
                width: "#{(ratingsNegative / ratingsAll) * 100}%"

          div className: 'beatmapset-stats__rating-values',
            span null, osu.formatNumber(ratingsNegative)
            span null, osu.formatNumber(ratingsPositive)

          div className: 'beatmapset-stats__rating-header', osu.trans 'beatmapsets.show.stats.rating-spread'

          div
            className: 'beatmapset-stats__rating-chart'
            ref: 'chartArea'


  _renderChart: ->
    return if !@props.beatmapset.is_scoreable

    unless @_ratingChart
      options =
        scales:
          x: d3.scaleLinear()
          y: d3.scaleLinear()
        modifiers: ['beatmapset-rating']

      ratingChart = new StackedBarChart @refs.chartArea, options
      $(window).on 'resize', ratingChart.resize
      @disposers.add(=> $(window).off 'resize', ratingChart.resize)
      @_ratingChart = ratingChart

    @disposers.add(core.reactTurbolinks.runAfterPageLoad =>
      @_ratingChart.loadData rating: @props.beatmapset.ratings[1..]
    )
