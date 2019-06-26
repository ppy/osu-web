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
import { div, a, span } from 'react-dom-factories'
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
          cssClasses = 'beatmapsets-search-filter__item'
          cssClasses += ' beatmapsets-search-filter__item--active' if @selected(option.id)

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
