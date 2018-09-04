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

    @state =
      active: false


  render: =>
    div
      className: 'play-detail-menu'
      onClick: @onClick
      i className: 'fas fa-ellipsis-v'
      @renderMenu()


  renderMenu: =>
    return null unless @state.active

    div
      className: "play-detail-menu__menu"
      div
        className: 'simple-menu'
        a
          className: 'simple-menu__item'
          href: laroute.route 'users.replay',
                  beatmap: @props.score.beatmap.id
                  mode: @props.score.beatmap.mode
                  user: @props.score.user_id
          'data-turbolinks': false
          'Download Replay'


  onClick: =>
    @setState active: !@state.active
