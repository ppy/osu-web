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

import { Map } from './map'
import { Incident } from './incident'
import { Incidents } from './incidents'
import { Uptime } from './uptime'
import * as React from 'react'
import { div, span, br, strong, h1, h4, h5 } from 'react-dom-factories'
el = React.createElement

export class Page extends React.Component
  constructor: (props) ->
    super props

    @chartArea = React.createRef()

    @state =
      status: window.osuStatus
      charts: window.osuStatus.uptime.graphs
      # mode
      graph: 'users' # users or score

  componentDidMount: =>
    @_stats()

  componentDidUpdate: =>
    @_stats()

  _changeViewMode: (mode, time, e) ->
    s = {}
    s[mode] = time
    @setState(s)

  _yAxisTickValues: (data) ->
    rankRange = d3.extent data, (d) => d.y
    @_allTicks = [1, 2.5, 5]

    while _.last(@_allTicks) <= _.last(rankRange)
      @_allTicks.push (10 * @_allTicks[@_allTicks.length - 3])

    ticks = [@_allTicks[0]]
    for tick in @_allTicks
      tick = Math.trunc(tick)
      if tick < rankRange[1]
        ticks[0] = tick
      else
        ticks.push tick
        break if tick < rankRange[0]
    if ticks[0] != 0
      ticks.unshift(0)
    ticks

  _stats: ->
    if _.isEmpty(@state.status.online.graphs.online) && _.isEmpty(@state.status.online.graphs.score)
      return

    data = []
    if @state.graph == 'users'
      data = @state.status.online.graphs.online
    else if @state.graph == 'score'
      data = @state.status.online.graphs.score

    data = data.map (players, j) =>
      x: j - data.length + 1
      y: players

    unless @_statsChart
      tickValues =
        x: [-12, -9, -6, -3, 0]

      domains =
        x: d3.extent(tickValues.x)

      formats =
        x: (d) =>
          if d == 0
            osu.trans('common.time.now')
          else
            osu.transChoice('common.time.hours_ago', -d)
        y: (d) =>
          osu.formatNumber(d)

      infoBoxFormats =
        x: (d) -> "#{formats.x(d)}"

      scales =
        x: d3.scaleLinear()
        y: d3.scaleLinear()

      options =
        formats: formats
        infoBoxFormats: infoBoxFormats
        scales: scales
        tickValues: tickValues
        domains: domains
        circleLine: true
        modifiers: ['status-page']

      @_statsChart = new LineChart(@chartArea.current, options)
      @_statsChart.margins.bottom = 65
      @_statsChart.xAxis.tickPadding 5

      $(window).on 'throttled-resize.profilePagePerformance', @_statsChart.resize

    yTickValues = @_yAxisTickValues data
    @_statsChart.options.tickValues.y = yTickValues
    @_statsChart.options.domains.y = d3.extent(yTickValues)
    @_statsChart.loadData(data)

  render: =>
    status = @state.status

    activeIncidents = false
    status.incidents.map (incident) =>
      if incident.active
        activeIncidents = true

    div
      className: 'osu-layout__row osu-layout__row--page--compact'
      div null,
        div className: 'status-header',
          span className: 'status-header__logo',
            null
          div className: 'status-header__text',
            h1 className: 'status-header__title',
              strong null,
                ['osu!']
              osu.trans("status_page.header.title")
            h4 className: 'status-header__desc',
              osu.trans('status_page.header.description')
        div className: "status-incidents osu-layout__row--page-compact #{(if activeIncidents then '' else 'hidden')}",
          h1 className: 'status-incidents__title',
            osu.trans('status_page.incidents.title')
          div null,
            status.incidents.map (incident, id) =>
              if incident.active
                el Incident,
                  key: id
                  description: incident.description
                  active: incident.active
                  status: incident.status
                  date: incident.date
                  by: incident.by
        el Map,
          servers: @state.status.servers
        div className: 'osu-layout__row--page-compact',
          h1 className: 'status-info__title',
            (if @state.graph == 'users' then osu.trans('status_page.online.title.users') else osu.trans('status_page.online.title.score'))
          div className: 'chart', ref: @chartArea
          div className: 'status-info__container',
            div className: 'status-info__border',
              null
            div
              className: "status-info__data #{(if @state.graph == 'users' then 'status-info__data--active' else '')}"
              onClick: @_changeViewMode.bind(@, 'graph', 'users')
              h4 className: 'status-info__data-title',
                osu.trans('status_page.online.current')
              h1 className: 'status-info__data-amount',
                osu.formatNumber(@state.status.online.current)
            div className: 'status-info__separator',
              null
            div
              className: "status-info__data #{(if @state.graph == 'score' then 'status-info__data--active' else '')}"
              onClick: @_changeViewMode.bind(@, 'graph', 'score')
              h4 className: 'status-info__data-title',
                osu.trans('status_page.online.score')
              h1 className: 'status-info__data-amount',
                osu.formatNumber(@state.status.online.score)
        div className: 'osu-layout__col-container osu-layout__col-container--with-gutter',
          el Incidents,
            incidents: @state.status.incidents
          el Uptime,
            charts: @state.charts
