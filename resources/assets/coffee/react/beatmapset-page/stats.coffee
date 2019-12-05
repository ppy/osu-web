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

import { BeatmapBasicStats } from 'beatmap-basic-stats'
import * as React from 'react'
import { a, div, span, table, tbody, td, th, tr, i } from 'react-dom-factories'
el = React.createElement

export class Stats extends React.Component
  constructor: (props) ->
    super props

    @state =
      preview: 'ended'
      previewDuration: 0


  componentDidMount: =>
    @_renderChart()

    $.subscribe 'osuAudio:initializing.beatmapsetPageStats', @previewInitializing
    $.subscribe 'osuAudio:playing.beatmapsetPageStats', @previewStart
    $.subscribe 'osuAudio:ended.beatmapsetPageStats', @previewStop


  componentWillUnmount: =>
    $(window).off '.beatmapsetPageStats'
    $.unsubscribe '.beatmapsetPageStats'


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
              when 'taiko' then ['drain', 'accuracy', 'stars']
              when 'mania' then ['cs', 'drain', 'accuracy', 'stars']
              else ['cs', 'drain', 'accuracy', 'ar', 'stars']

    div className: 'beatmapset-stats',
      a
        href: '#'
        className: "beatmapset-stats__row beatmapsets-stats__row beatmapset-stats__row--preview js-audio--play"
        'data-audio-url': @props.beatmapset.preview_url
        span className: 'beatmapset-stats__preview-icon',
          i className: "fas fa-#{if @state.preview == 'ended' then 'play' else 'stop'}"

        div
          className: 'beatmapset-stats__elapsed-bar'
          style:
            transitionDuration: "#{@state.previewDuration}s"
            width: "#{if @state.preview == 'playing' then '100%' else 0}"

      div className: 'beatmapset-stats__row beatmapset-stats__row--basic',
        el BeatmapBasicStats,
          beatmapset: @props.beatmapset
          beatmap: @props.beatmap

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


  previewInitializing: (_e, {url, player}) =>
    if url != @props.beatmapset.preview_url
      return @previewStop()

    @setState
      preview: 'initializing'
      previewDuration: 0


  previewStart: (_e, {url, player}) =>
    if url != @props.beatmapset.preview_url
      return @previewStop()

    @setState
      preview: 'playing'
      previewDuration: player.duration


  previewStop: =>
    return if @state.preview == 'ended'

    @setState
      preview: 'ended'
      previewDuration: 0


  _renderChart: ->
    return if !@props.beatmapset.is_scoreable

    unless @_ratingChart
      options =
        scales:
          x: d3.scaleLinear()
          y: d3.scaleLinear()
        modifiers: ['beatmapset-rating']

      @_ratingChart = new StackedBarChart @refs.chartArea, options
      $(window).on 'throttled-resize.beatmapsetPageStats', @_ratingChart.resize

    @_ratingChart.loadData rating: @props.beatmapset.ratings[1..]
