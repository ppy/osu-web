# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div, h1, h5 } from 'react-dom-factories'
el = React.createElement

export class Uptime extends React.Component
  constructor: (props) ->
    super props
    @state =
      when: 'today'

  componentDidMount: =>
    @_charts()

  componentDidUpdate: =>
    @_charts()

  _changeViewMode: (time, e) ->
    @setState =>
      when: time

  _charts: ->
    @charts ?=
      server: new StatusChart(@refs.serverChart, 'server')
      web: new StatusChart(@refs.webChart, 'web')

    @charts.server.set(@props.charts.server[@state.when])
    @charts.web.set(@props.charts.web[@state.when])

  render: =>
    div className: 'status-recent osu-layout__col osu-layout__col--sm-6 osu-layout__row--page-compact',
      h1 className: 'status-recent__title',
        osu.trans('status_page.recent.uptime.title')
      div null,
        h5
          onClick: @_changeViewMode.bind(@, 'today')
          className: 'status-recent__when' + (if @state.when == 'today' then ' status-recent__when--active' else '')
          osu.trans('status_page.recent.when.today')
        h5
          onClick: @_changeViewMode.bind(@, 'week')
          className: 'status-recent__when' + (if @state.when == 'week' then ' status-recent__when--active' else '')
          osu.trans('status_page.recent.when.week')
        h5
          onClick: @_changeViewMode.bind(@, 'month')
          className: 'status-recent__when' + (if @state.when == 'month' then ' status-recent__when--active' else '')
          osu.trans('status_page.recent.when.month')
        h5
          onClick: @_changeViewMode.bind(@, 'all_time')
          className: 'status-recent__when' + (if @state.when == 'all_time' then ' status-recent__when--active' else '')
          osu.trans('status_page.recent.when.all_time')
      div className: 'status-charts osu-layout__col-container',
        div
          className: 'status-charts__chart osu-layout__col osu-layout__col--sm-6'
          ref: 'serverChart'
        div
          className: 'status-charts__chart osu-layout__col osu-layout__col--sm-6'
          ref: 'webChart'
