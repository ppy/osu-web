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
  #region Shared handler for picking up clicks ouside the element
  # TODO: extract for sharing with other components
  refs = {}
  document.addEventListener 'click', (event) ->
    for own _uuid, ref of refs
      ref event


  @register: (uuid, ref) ->
    refs[uuid] = ref


  @unregister: (uuid) ->
    delete refs[uuid]

  #endregion

  constructor: (props) ->
    super props

    @uuid = osu.uuid()
    @menu = createRef()

    @state =
      active: false


  componentDidMount: =>
    PlayDetailMenu.register @uuid, @hide


  componentWillUnmount: =>
    PlayDetailMenu.unregister @uuid


  hide: (e) =>
    @setState active: false if event.button == 0 && !(@menu.current in event.composedPath())
    @props.onHide?()


  onClick: =>
    @setState active: !@state.active
    @props.onShow?()


  render: =>
    button
      className: 'play-detail-menu'
      type: 'button'
      onClick: @onClick
      i className: 'fas fa-ellipsis-v'
      @renderMenu()


  renderMenu: =>
    # using Fade.in causes rendering glitches from the stacking context due to will-change
    return null unless @state.active

    div
      className: "play-detail-menu__menu"
      div
        className: 'simple-menu'
        ref: @menu
        a
          className: 'simple-menu__item'
          href: laroute.route 'users.replay',
                  beatmap: @props.score.beatmap.id
                  mode: @props.score.beatmap.mode
                  user: @props.score.user_id
          'data-turbolinks': false
          osu.trans 'users.show.extra.top_ranks.download_replay'
