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

import { createElement as el, createRef, PureComponent } from 'react'
import { button, div, i } from 'react-dom-factories'

export class BackToTop extends PureComponent
  constructor: (props) ->
    super props

    @container = createRef()

    @state =
      lastScrollY: null


  componentWillUnmount: =>
    document.removeEventListener 'scroll', @onScroll
    @observer?.disconnect()


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


  mountObserver: =>
    # workaround Firefox srollTo and setTimeout(fn, 0) not being dispatched serially
    if window.IntersectionObserver?
      return if @observer?

      # anchor to body if none specified; assumes body's top is 0.
      target = @props.anchor?.current ? document.body

      callback = (entries) =>
        for entry in entries
          if entry.target == target && entry.boundingClientRect.top == 0
            # also gets attached when scrolling downwards, but should be fine in this case.
            document.addEventListener 'scroll', @onScroll
            break

      @observer = new IntersectionObserver(callback)
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
      ref: @container
      i className: if @state.lastScrollY? then 'fas fa-angle-down' else 'fas fa-angle-up'


  reset: () =>
    @setState lastScrollY: null
