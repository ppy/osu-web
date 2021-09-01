# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton'
import * as React from 'react'
import { div, a, span } from 'react-dom-factories'
import { classWithModifiers } from 'utils/css'
el = React.createElement
controller = core.beatmapsetSearchController

export class SearchFilter extends React.PureComponent
  constructor: (props) ->
    super props

    @cache = {}


  componentWillReceiveProps: (nextProps) =>
    @cache = {}


  render: =>
    div className: 'beatmapsets-search-filter',
      if @props.title?
        span className: 'beatmapsets-search-filter__header', @props.title

      div className: 'beatmapsets-search-filter__items',
        for option, i in @props.options
          cssClasses = classWithModifiers 'beatmapsets-search-filter__item',
            active: @selected(option.id)
            'featured-artists': option.id == 'featured_artists'

          text = option.name
          if @props.name == 'general' && option.id == 'recommended' && @props.recommendedDifficulty?
            text += " (#{osu.formatNumber(@props.recommendedDifficulty, 2)})"

          a
            key: i
            href: @href(option)
            className: cssClasses
            'data-filter-value': option.id
            onClick: @select
            text


  cast: (value) =>
    BeatmapsetFilter.castFromString[@props.name]?(value) ? value ? null


  href: ({ id }) =>
    updatedFilter = {}
    updatedFilter[@props.name] = @newSelection(id)
    filters = _.assign {}, @props.filters.values, updatedFilter

    osu.updateQueryString null, BeatmapsetFilter.queryParamsFromFilters(filters)


  select: (e) =>
    e.preventDefault()
    controller.updateFilters "#{@props.name}": @newSelection(e.target.dataset.filterValue) ? null


  # TODO: rename
  newSelection: (id) =>
    i = @cast(id)
    if @props.multiselect
      _(@currentSelection())[if @selected(i) then 'without' else 'concat'](i).sort().join('.')
    else
      if @selected(i) then BeatmapsetFilter.defaults[id] else i


  selected: (i) =>
    i in @currentSelection()


  currentSelection: =>
    @cache.currentSelection ?=
      if @props.multiselect
        _(@props.selected ? '')
          .split('.')
          .filter (s) =>
            s in _.map(@props.options, 'id')
          .value()
      else
        [@props.selected]
