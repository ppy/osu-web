# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

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
    else if @props.filters.status in ['any', 'favourites', 'mine']
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
