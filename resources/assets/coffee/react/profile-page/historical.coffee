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

import { BeatmapPlaycount } from './beatmap-playcount'
import { ExtraHeader } from './extra-header'
import { PlayDetailList } from 'play-detail-list'
import * as React from 'react'
import { a, div, h2, h3, img, p, small, span } from 'react-dom-factories'
import { ShowMoreLink } from 'show-more-link'
el = React.createElement


export class Historical extends React.PureComponent
  constructor: (props) ->
    super props

    @id = "users-show-historical-#{osu.uuid()}"
    @monthlyPlaycountsChartArea = React.createRef()
    @replaysWatchedCountsChartArea = React.createRef()

    @charts = {}


  componentDidMount: =>
    $(window).on "throttled-resize.#{@id}", @resizeCharts
    @monthlyPlaycountsChartUpdate()
    @replaysWatchedCountsChartUpdate()


  componentDidUpdate: =>
    @monthlyPlaycountsChartUpdate()
    @replaysWatchedCountsChartUpdate()


  componentWillUnmount: =>
    $(window).off ".#{@id}"


  render: =>
    div
      className: 'page-extra'

      el ExtraHeader, name: @props.name, withEdit: @props.withEdit

      if @hasMonthlyPlaycounts()
        div null,
          h3
            className: 'title title--page-extra-small'
            osu.trans('users.show.extra.historical.monthly_playcounts.title')

          div
            className: 'page-extra__chart'
            ref: @monthlyPlaycountsChartArea


      h3
        className: 'title title--page-extra-small'
        osu.trans('users.show.extra.historical.most_played.title')

      if @props.beatmapPlaycounts?.length
        [
          for playcount in @props.beatmapPlaycounts
            el BeatmapPlaycount,
              key: playcount.beatmap.id
              playcount: playcount
          el ShowMoreLink,
            key: 'show-more-row'
            modifiers: ['profile-page', 't-greyseafoam-dark']
            event: 'profile:showMore'
            hasMore: @props.pagination.beatmapPlaycounts.hasMore
            loading: @props.pagination.beatmapPlaycounts.loading
            data:
              name: 'beatmapPlaycounts'
              url: laroute.route 'users.beatmapsets',
                  user: @props.user.id
                  type: 'most_played'
        ]

      else
        p null, osu.trans('users.show.extra.historical.empty')

      h3
        className: 'title title--page-extra-small'
        osu.trans('users.show.extra.historical.recent_plays.title')

      if @props.scoresRecent?.length
        [
          el PlayDetailList, key: 'play-detail-list', scores: @props.scoresRecent

          el ShowMoreLink,
            key: 'show-more-row'
            modifiers: ['profile-page', 't-greyseafoam-dark']
            event: 'profile:showMore'
            hasMore: @props.pagination.scoresRecent.hasMore
            loading: @props.pagination.scoresRecent.loading
            data:
              name: 'scoresRecent'
              url: laroute.route 'users.scores',
                  user: @props.user.id
                  type: 'recent'
                  mode: @props.currentMode
        ]

      else
        p null, osu.trans('users.show.extra.historical.empty')

      if @hasReplaysWatchedCounts()
        div null,
          h3
            className: 'title title--page-extra-small'
            osu.trans('users.show.extra.historical.replays_watched_counts.title')

          div
            className: 'page-extra__chart'
            ref: @replaysWatchedCountsChartArea


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
    if osu.isDesktop()
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
