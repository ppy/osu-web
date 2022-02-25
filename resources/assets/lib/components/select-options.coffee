# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { a, i, div } from 'react-dom-factories'
import { createRef, PureComponent } from 'react'
import { blackoutToggle } from 'utils/blackout'

export class SelectOptions extends PureComponent
  constructor: (props) ->
    super props
    @bn = @props.bn ? 'select-options'
    @hasBlackout = @props.blackout || @props.blackout == undefined
    @ref = createRef()

    @state =
      showingSelector: false


  componentDidMount: =>
    document.addEventListener 'click', @hideSelector


  componentDidUpdate: (_prevProps, prevState) =>
    blackoutToggle(@state.showingSelector, 0.5) if @hasBlackout && prevState.showingSelector != @state.showingSelector


  componentWillUnmount: ->
    document.removeEventListener 'click', @hideSelector


  # dismiss the selector if clicking anywhere outside of it.
  hideSelector: (e) =>
    @setState showingSelector: false if e.button == 0 && !(@ref.current in e.composedPath())


  optionSelected: (event, option) =>
    return if event.button != 0
    event.preventDefault()

    @setState showingSelector: false
    @props.onChange?(option)


  render: =>
    classNames = "#{@bn}"
    classNames += " #{@bn}--selecting" if @state.showingSelector

    div
      className: classNames
      ref: @ref
      div
        className: "#{@bn}__select"
        @renderOption
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
          onClick: @toggleSelector
          option: @props.selected

      div
        className: "#{@bn}__selector"
        @renderOptions()


  renderOption: ({ children, onClick, option, selected = false }) =>
    cssClasses = "#{@bn}__option"
    cssClasses += " #{@bn}__option--selected" if selected

    return @props.renderOption({ children, cssClasses, onClick, option }) if @props.renderOption?

    a
      className: cssClasses
      href: '#'
      key: option.id
      onClick: onClick
      children


  renderOptions: =>
    for option in @props.options
      do (option) =>
        @renderOption
          children: [
            div
              className: 'u-ellipsis-overflow'
              key: option.id
              option.text
          ],
          onClick: (event) => @optionSelected(event, option)
          option: option
          selected: @props.selected?.id == option.id


  toggleSelector: (event) =>
    return if event.button != 0
    event.preventDefault()

    @setState showingSelector: !@state.showingSelector
