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

class Beatmaps.SearchFilter extends React.Component
  constructor: (props) ->
    super props

    if @props.default != undefined
      if @props.multiselect
        selected = @props.default.split('-')
      else
        selected = @props.default

    @state =
      selected: [].concat(selected)

  @defaultProps: ->
    multiselect: false
    selected: []
    default: []

  @propTypes:
    title: React.PropTypes.string.isRequired
    options: React.PropTypes.arrayOf(React.PropTypes.object).isRequired
    selected: React.PropTypes.string
    multiselect: React.PropTypes.bool

  select: (i, e) ->
    if @selected(i)
      if @props.multiselect
        @setState { selected: _.without(@state.selected, i) }, @triggerUpdate
      else
        @setState { selected: [].concat(@props.default) }, @triggerUpdate
    else
      if @props.multiselect
        @setState { selected: @state.selected.concat(i) }, @triggerUpdate
      else
        @setState { selected: [ i ] }, @triggerUpdate

  clickReject: (e) ->
    e.preventDefault()

  componentWillReceiveProps: (props) ->
    if @state.selected != props.selected
      if @props.multiselect
        selected = props.selected?.split('-')
      else
        selected = props.selected

      @setState {selected: [].concat(selected)}

  triggerUpdate: ->
    if @props.multiselect
      value = @state.selected.filter (n) ->
        n != undefined && n != null && n != ""
      .join('-')
    else
      value = @state.selected[0]

    payload =
      name: @props.name
      value: value
    $(document).trigger 'beatmap:search:filtered', payload

  selected: (i) ->
    $.inArray(i, @state.selected) > -1

  render: ->
    selectors = []
    $.each @props.options, (i, e) =>
      selectors.push a href:'#', className: ('active' if @selected(e['id'])), value: e['id'], key: i, onClick: @clickReject, onMouseDown: @select.bind(@, e['id']), e['name']

    div id: @props.id, className: 'selector', 'data-name': @props.name,
      span className:'header', @props.title
      selectors
