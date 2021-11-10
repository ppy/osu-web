# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import BeatmapPlaycount from 'profile-page/beatmap-playcount'
import LineChart from 'd3/line-chart'
import ExtraHeader from 'profile-page/extra-header'
import core from 'osu-core-singleton'
import PlayDetailList from 'play-detail-list'
import * as React from 'react'
import { a, div, h2, h3, img, p, small, span } from 'react-dom-factories'
import ShowMoreLink from 'show-more-link'
import { nextVal } from 'utils/seq'
el = React.createElement


export class Historical extends React.PureComponent
  constructor: (props) ->
    super props

    @id = "users-show-historical-#{nextVal()}"
    @monthlyPlaycountsChartArea = React.createRef()
    @replaysWatchedCountsChartArea = React.createRef()

    @charts = {}


  componentDidMount: =>
    $(window).on "resize.#{@id}", @resizeCharts
    @monthlyPlaycountsChartUpdate()
    @replaysWatchedCountsChartUpdate()


  componentDidUpdate: =>
    @monthlyPlaycountsChartUpdate()
    @replaysWatchedCountsChartUpdate()


  componentWillUnmount: =>
    $(window).off ".#{@id}"
    $(document).off ".#{@id}"


  render: =>
    div
      className: 'page-extra'

      el ExtraHeader, name: @props.name, withEdit: @props.withEdit

      if @hasMonthlyPlaycounts()
        el React.Fragment, null,
          h3
            className: 'title title--page-extra-small'
            osu.trans('users.show.extra.historical.monthly_playcounts.title')

          div className: 'page-extra__chart',
            div ref: @monthlyPlaycountsChartArea


      h3
        className: 'title title--page-extra-small'
        osu.trans('users.show.extra.historical.most_played.title')
        span className: 'title__count', osu.formatNumber(@props.user.beatmap_playcounts_count)

      if (@props.beatmapPlaycounts?.length ? 0) != 0
        el React.Fragment, null,
          for playcount in @props.beatmapPlaycounts
            el BeatmapPlaycount,
              key: playcount.beatmap.id
              playcount: playcount
              currentMode: @props.currentMode
          el ShowMoreLink,
            key: 'show-more-row'
            modifiers: 'profile-page'
            event: 'profile:showMore'
            hasMore: @props.pagination.beatmapPlaycounts.hasMore
            loading: @props.pagination.beatmapPlaycounts.loading
            data:
              name: 'beatmapPlaycounts'
              url: laroute.route 'users.beatmapsets',
                  user: @props.user.id
                  type: 'most_played'

      h3
        className: 'title title--page-extra-small'
        osu.trans('users.show.extra.historical.recent_plays.title')
        span className: 'title__count', osu.formatNumber(@props.user.scores_recent_count)

      if (@props.scoresRecent?.length ? 0) != 0
        el React.Fragment, null,
          el PlayDetailList, key: 'play-detail-list', scores: @props.scoresRecent

          el ShowMoreLink,
            key: 'show-more-row'
            modifiers: 'profile-page'
            event: 'profile:showMore'
            hasMore: @props.pagination.scoresRecent.hasMore
            loading: @props.pagination.scoresRecent.loading
            data:
              name: 'scoresRecent'
              url: laroute.route 'users.scores',
                  user: @props.user.id
                  type: 'recent'
                  mode: @props.currentMode

      if @hasReplaysWatchedCounts()
        el React.Fragment, null,
          h3
            className: 'title title--page-extra-small'
            osu.trans('users.show.extra.historical.replays_watched_counts.title')

          div className: 'page-extra__chart',
            div ref: @replaysWatchedCountsChartArea


  chartUpdate: (attribute, area) =>
    dataPadder = (padded, entry) ->
      if padded.length > 0
        lastEntry = _.last(padded)
        missingMonths = entry.x.diff(lastEntry.x, 'months') - 1

        _.times missingMonths, (i) ->
          padded.push
            x: lastEntry.x.clone().add(i + 1, 'months')
            y: 0

      padded.push entry
      padded

    data = _(@props.user[attribute])
      .sortBy 'start_date'
      .map (count) ->
        x: moment(count.start_date)
        y: count.count
      .reduce dataPadder, []

    if data.length == 1
      data.unshift
        x: data[0].x.clone().subtract(1, 'month')
        y: 0

    if !@charts[attribute]?
      options =
        curve: d3.curveLinear
        formats:
          x: (d) -> moment(d).format(osu.trans('common.datetime.year_month_short.moment'))
          y: (d) -> osu.formatNumber(d)
        margins: right: 60 # more spacing for x axis label
        infoBoxFormats:
          x: (d) -> moment(d).format(osu.trans('common.datetime.year_month.moment'))
          y: (d) -> "<strong>#{osu.trans("users.show.extra.historical.#{attribute}.count_label")}</strong> #{_.escape(osu.formatNumber(d))}"
        tickValues: {}
        ticks: {}
        circleLine: true
        modifiers: ['profile-page']

      @charts[attribute] = new LineChart(area, options)

    core.reactTurbolinks.runAfterPageLoad @id, =>
      @updateTicks @charts[attribute], data
      @charts[attribute].loadData data


  hasMonthlyPlaycounts: =>
    @props.user.monthly_playcounts.length > 0


  hasReplaysWatchedCounts: =>
    @props.user.replays_watched_counts.length > 0


  monthlyPlaycountsChartUpdate: =>
    return if !@hasMonthlyPlaycounts()

    @chartUpdate 'monthly_playcounts', @monthlyPlaycountsChartArea.current


  replaysWatchedCountsChartUpdate: =>
    return if !@hasReplaysWatchedCounts()

    @chartUpdate 'replays_watched_counts', @replaysWatchedCountsChartArea.current


  updateTicks: (chart, data) =>
    if core.windowSize.isDesktop
      chart.options.ticks.x = null

      data ?= chart.data
      chart.options.tickValues.x =
        if data.length < 10
          data.map (d) -> d.x
        else
          null
    else
      chart.options.ticks.x = Math.min(6, (data ? chart.data).length)
      chart.options.tickValues.x = null


  resizeCharts: =>
    for own _name, chart of @charts
      @updateTicks chart
      chart.resize()
