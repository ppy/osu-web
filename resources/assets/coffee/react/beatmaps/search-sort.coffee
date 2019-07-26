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

import core from 'osu-core-singleton'
import * as React from 'react'
import { div, a, i, span } from 'react-dom-factories'
el = React.createElement
controller = core.beatmapsetSearchController

export class SearchSort extends React.PureComponent
  render: =>
    div className: 'sort sort--beatmapsets',
      div className: 'sort__items',
        span className: 'sort__item sort__item--title', osu.trans('sort._')
        for field in @fields()
          selected = @selected(field)

          a
            key: field
            href: '#'
            className: "sort__item sort__item--button #{'sort__item--active' if selected}"
            onClick: @select
            'data-field': field
            osu.trans "beatmaps.listing.search.sorting.#{field}"
            span
              className: 'sort__item-arrow'
              i className: "fas fa-caret-#{if @props.sorting.order == 'asc' then 'up' else 'down'}"


  fields: =>
    fields =
      title: true
      artist: true
      difficulty: true
      updated: false
      ranked: false
      rating: true
      plays: true
      favourites: true
      relevance: false
      nominations: false

    if !_.isEmpty(@props.filters.query)
      fields.relevance = true

    if @props.filters.status in ['graveyard', 'pending']
      fields.updated = true
      fields.nominations = true
      fields.plays = false
    else if @props.filters.status == 'mine'
      fields.updated = true
      fields.ranked = true
    else
      fields.ranked = true


    field for own field, enabled of fields when enabled


  select: (e) =>
    e.preventDefault()
    field = e.currentTarget.dataset.field
    order = @props.sorting.order

    if @selected(field)
      order = if order == 'asc' then 'desc' else 'asc'
    else
      order = 'desc'

    controller.updateFilters sort: "#{field}_#{order}"


  selected: (field) =>
    @props.sorting.field == field
