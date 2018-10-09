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
import { a, button, div, i } from 'react-dom-factories'

export class PlayDetailMenu extends PureComponent
  constructor: (props) ->
    super props

    @uuid = osu.uuid()
    @menu = createRef()

    @state =
      active: false


  componentDidMount: =>
    $(document).on "click.#{@uuid}", @hide
    $(document).on "keyup.#{@uuid}", @hide


  componentDidUpdate: (_prevProps, prevState) =>
    if prevState.active != @state.active
      if @state.active then @props.onShow?() else @props.onHide?()


  componentWillUnmount: =>
    $(document).off ".#{@uuid}", @hide


  hide: (e) =>
    return if !@state.active

    event = e.originalEvent
    if event.keyCode == 27 || (event.button == 0 && !(@menu.current in event.composedPath()))
      @setState active: false


  toggle: =>
    @setState active: !@state.active


  render: =>
    div
      className: 'play-detail-menu'
      ref: @menu
      button
        className: 'play-detail-menu__button'
        type: 'button'
        onClick: @toggle
        i className: 'fas fa-ellipsis-v'

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
