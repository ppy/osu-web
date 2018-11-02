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
import { createPortal } from 'react-dom'
import { a, button, div, i } from 'react-dom-factories'
import { ReportScore } from 'report-score'
import { Modal } from 'modal'

export class PlayDetailMenu extends PureComponent
  @defaultProps =
    usePortal: false


  constructor: (props) ->
    super props

    @uuid = osu.uuid()
    @menu = createRef()

    @body = document.body
    @portal = document.createElement('div') if props.usePortal
    @portalAdded = false

    @state =
      active: false


  componentDidMount: =>
    $(document).on "turbolinks:before-cache.#{@uuid}", () =>
      @removePortal()


  componentDidUpdate: (_prevProps, prevState) =>
    return if prevState.active == @state.active

    if @state.active
      if @portal?
        element$ = $(@menu.current)
        { top, left } = element$.offset()

        @portal.style.position = 'absolute'
        @portal.style.top = "#{Math.floor(top + element$.height() / 2)}px"
        @portal.style.left = "#{Math.floor(left + element$.width())}px"

        @addPortal()

      $(document).on "click.#{@uuid} keydown.#{@uuid}", @hide
      @props.onShow?()
    else
      @removePortal()
      $(document).off "click.#{@uuid} keydown.#{@uuid}"
      @props.onHide?()


  componentWillUnmount: =>
    $(document).off ".#{@uuid}"


  hide: (e) =>
    return if !@state.active || Modal.isOpen()

    event = e.originalEvent
    return if !event? # originalEvent gets eaten by error popup?

    if event.keyCode == 27 || (event.button == 0 && !@isMenuInPath(event.composedPath()))
      @setState active: false


  isMenuInPath: (path) =>
    @menu.current in path || @portal in path


  toggle: =>
    @setState active: !@state.active


  addPortal: =>
    if @portal? && !@portalAdded
      @body.appendChild @portal
      @portalAdded = true


  removePortal: =>
    if @portal? && @portalAdded
      @body.removeChild @portal
      @portalAdded = false


  render: =>
    div
      className: 'play-detail-menu'
      ref: @menu
      button
        className: 'play-detail-menu__button'
        type: 'button'
        onClick: @toggle
        i className: 'fas fa-ellipsis-v'

      if @props.usePortal
        createPortal @renderMenu(), @portal

      else
        @renderMenu()


  renderMenu: =>
    # using Fade.in causes rendering glitches from the stacking context due to will-change
    return null unless @state.active

    div
      className: "play-detail-menu__menu"
      div
        className: 'simple-menu simple-menu--play-detail-menu'
        a
          className: 'simple-menu__item'
          href: laroute.route 'users.replay',
                  beatmap: @props.score.beatmap.id
                  mode: @props.score.beatmap.mode
                  user: @props.score.user_id
          'data-turbolinks': false
          onClick: @toggle
          osu.trans 'users.show.extra.top_ranks.download_replay'

        el ReportScore,
          { score } = @props
