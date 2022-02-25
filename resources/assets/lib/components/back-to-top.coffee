# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { createElement as el, createRef, PureComponent } from 'react'
import * as React from 'react'
import { button, div, i } from 'react-dom-factories'

export class BackToTop extends PureComponent
  constructor: (props) ->
    super props

    @state =
      lastScrollY: null


  componentWillUnmount: =>
    document.removeEventListener 'scroll', @onScroll
    if @observer?
      @observer.disconnect()
      @observer = null


  onClick: (_e) =>
    if @state.lastScrollY?
      window.scrollTo(window.pageXOffset, @state.lastScrollY)

      @setState lastScrollY: null
    else
      scrollY = if @props.anchor?.current? then $(@props.anchor.current).offset().top else 0
      if window.pageYOffset > scrollY
        @setState lastScrollY: window.pageYOffset

        window.scrollTo(window.pageXOffset, scrollY)
        @mountObserver()


  onScroll: (_e) =>
    @setState lastScrollY: null
    document.removeEventListener 'scroll', @onScroll
    if @observer?
      @observer.disconnect()
      @observer = null


  mountObserver: =>
    # Workaround Firefox scrollTo and setTimeout(fn, 0) not being dispatched serially.
    # Browsers without IntersectionObservers don't have this problem :D
    if window.IntersectionObserver?
      # anchor to body if none specified; assumes body's top is 0.
      target = @props.anchor?.current ? document.body

      @observer = new IntersectionObserver (entries) =>
        for entry in entries
          if entry.target == target && entry.boundingClientRect.top == 0
            document.addEventListener 'scroll', @onScroll
            break

      @observer.observe(target)
    else
      Timeout.set 0, () =>
        document.addEventListener 'scroll', @onScroll


  render: =>
    button
      className: 'back-to-top'
      'data-tooltip-float': 'fixed'
      onClick: @onClick
      title: if @state.lastScrollY? then osu.trans('common.buttons.back_to_previous') else osu.trans('common.buttons.back_to_top')
      i className: if @state.lastScrollY? then 'fas fa-angle-down' else 'fas fa-angle-up'


  reset: () =>
    @setState lastScrollY: null
