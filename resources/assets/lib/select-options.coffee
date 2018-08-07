###
#    Copyright 2015-2018 ppy Pty. Ltd.
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

import { a, i, div } from 'react-dom-factories'
import { createRef, PureComponent } from 'react'

export class SelectOptions extends PureComponent
  constructor: (props) ->
    super props
    @bn = @props.bn ? 'select-options'
    @ref = createRef()

    @state =
      showingSelector: false


  componentDidMount: =>
    element.addEventListener 'click', @hideSelector for element in Blackout.el


  componentDidUpdate: (_prevProps, prevState) =>
    Blackout.toggle(@state.showingSelector, 0.5) unless prevState.showingSelector == @state.showingSelector


  componentWillUnmount: ->
    element.removeEventListener 'click', @hideSelector for element in Blackout.el


  render: =>
    classNames = "#{@bn}"
    classNames += " #{@bn}--selecting" if @state.showingSelector

    div
      className: classNames
      ref: @ref
      div
        className: "#{@bn}__select"
        @renderItem
          children: [
            div
              className: 'u-ellipsis-overflow'
              key: 'current'
              @props.selected?.text

            div
              key: 'decoration'
              className: "#{@bn}__decoration",
              i className: "fas fa-chevron-down"
          ]
          item: @props.selected
          onClick: @toggleSelector

      div
        className: "#{@bn}__selector"
        for item in @props.options
          @renderOption item


  renderOption: (item) =>
    @renderItem
      children: [
        div
          className: 'u-ellipsis-overflow'
          key: item.id
          item.text
      ],
      item: item
      selected: @props.selected?.id == item.id
      onClick: (event) => @itemSelected(event, item)


  renderItem: ({ children, item, onClick, selected = false }) ->
    cssClasses = "#{@bn}__item"
    cssClasses += " #{@bn}__item--selected" if selected

    return @props.renderItem({ children, item, onClick, cssClasses }) if @props.renderItem?

    a
      children: children
      className: cssClasses
      href: '#'
      key: item.id
      onClick: onClick


  hideSelector: (e) =>
    @setState showingSelector: false if e.button == 0


  itemSelected: (event, item) ->
    return if event.button != 0
    event.preventDefault()

    @setState showingSelector: false
    @props.onItemSelected?(item)


  toggleSelector: (event) =>
    return if event.button != 0
    event.preventDefault()

    @setState showingSelector: !@state.showingSelector
