###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

{div, a, span} = React.DOM
el = React.createElement

class Beatmaps.SearchSort extends React.PureComponent
  render: =>
    div className: 'beatmapsets-sorting',
      for field in ['title', 'artist', 'difficulty', 'ranked', 'rating', 'plays']
        selected = @selected(field)

        a
          key: field
          href: '#'
          className: "beatmapsets-sorting__item #{'beatmapsets-sorting__item--selected' if selected}"
          onClick: @select
          'data-field': field
          field
          span
            className: 'beatmapsets-sorting__item-arrow'
            'data-visibility': ('hidden' if !selected)
            el Icon, name: "caret-#{if @props.sorting.order == 'asc' then 'up' else 'down'}"


  select: (e) =>
    e.preventDefault()
    field = e.currentTarget.dataset.field
    order = @props.sorting.order

    if @selected(field)
      order = if order == 'asc' then 'desc' else 'asc'
    else
      order = 'desc'

    $(document).trigger 'beatmap:search:filtered', sort: "#{field}_#{order}"


  selected: (field) =>
    @props.sorting.field == field
