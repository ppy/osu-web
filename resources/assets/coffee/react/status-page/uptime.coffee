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
