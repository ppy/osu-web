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

import { Incident } from './incident'
import * as React from 'react'
import { div, h1, h5 } from 'react-dom-factories'
el = React.createElement

export class Incidents extends React.Component
  constructor: (props) ->
    super props
    @state =
      when: 'today'

  _changeViewMode: (time, e) ->
    @setState =>
      when: time

  render: =>
    incidents = @props.incidents.map (incident, id) =>
      ok = false
      if @state.when == 'today' && moment().isSame(moment(incident.date, 'DD-MM-YYYY'), 'days')
        ok = true
      else if @state.when == 'last_week' && moment(incident.date, 'DD-MM-YYYY').isBetween(moment().subtract(1, 'week'), moment())
        ok = true
      else if @state.when == '2_weeks' && moment(incident.date, 'DD-MM-YYYY').isBetween(moment().subtract(2, 'weeks'), moment().subtract(1, 'week'))
        ok = true
      else if @state.when == '3_weeks' && moment(incident.date, 'DD-MM-YYYY').isBetween(moment().subtract(3, 'weeks'), moment().subtract(2, 'weeks'))
        ok = true

      if ok
        el Incident,
          key: id
          description: incident.description
          active: incident.active
          status: incident.status
          date: incident.date
          by: incident.by

    div className: 'status-recent osu-layout__col osu-layout__col--sm-6 osu-layout__row--page-compact',
      h1 className: 'status-recent__title',
        osu.trans('status_page.recent.incidents.title')
      div null,
        h5
          onClick: @_changeViewMode.bind(@, 'today')
          className: 'status-recent__when' + (if @state.when == 'today' then ' status-recent__when--active' else '')
          osu.trans('status_page.recent.when.today')
        h5
          onClick: @_changeViewMode.bind(@, 'last_week')
          className: 'status-recent__when' + (if @state.when == 'last_week' then ' status-recent__when--active' else '')
          osu.trans('status_page.recent.when.last_week')
        h5
          onClick: @_changeViewMode.bind(@, '2_weeks')
          className: 'status-recent__when' + (if @state.when == '2_weeks' then ' status-recent__when--active' else '')
          osu.transChoice('status_page.recent.when.weeks_ago', 2)
        h5
          onClick: @_changeViewMode.bind(@, '3_weeks')
          className: 'status-recent__when' + (if @state.when == '3_weeks' then ' status-recent__when--active' else '')
          osu.transChoice('status_page.recent.when.weeks_ago', 3)
      div className: 'status-incident--no-line',
        incidents
