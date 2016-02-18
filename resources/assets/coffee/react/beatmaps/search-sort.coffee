###*
*    Copyright 2015 ppy Pty. Ltd.
*
*    This file is part of osu!web. osu!web is distributed with the hope of
*    attracting more community contributions to the core ecosystem of osu!.
*
*    osu!web is free software: you can redistribute it and/or modify
*    it under the terms of the Affero GNU General Public License version 3
*    as published by the Free Software Foundation.
*
*    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
*    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*    See the GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
*
###

{div,a,span} = React.DOM
el = React.createElement

class Beatmaps.SearchSort extends React.Component
  select: (i, e) ->
    order = @props.sorting.order

    if @selected(i)
      order = if order == 'asc' then 'desc' else 'asc'
    else
      order = 'desc'

    $(document).trigger 'beatmap:search:sorted',
      field: i,
      order: order

  clickReject: (e) ->
    e.preventDefault()

  selected: (i) ->
    @props.sorting.field == i

  render: ->
    options = [
      {id: 'title', name: 'title'},
      {id: 'artist', name: 'artist'},
      {id: 'difficulty', name: 'difficulty'},
      {id: 'ranked', name: 'ranked'},
      {id: 'rating', name: 'rating'},
      {id: 'plays', name: 'plays'}
    ]
    selectors = []
    $.each options, (i, e) =>
      classes = []
      if @selected(e['id'])
        classes = ['active', @props.sorting.order]
      selectors.push a href:'#', className: classes.join(' '), value: e['id'], key: i, onClick: @clickReject, onMouseDown: @select.bind(@, e['id']), e['name']

    div className: 'sorting',
      selectors
