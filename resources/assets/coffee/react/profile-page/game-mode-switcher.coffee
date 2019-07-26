###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

import * as React from 'react'
import { a, button, div, li, span, ul } from 'react-dom-factories'
el = React.createElement
bn = 'game-mode'


export class GameModeSwitcher extends React.PureComponent
  constructor: (props) ->
    super props

    @state = settingDefault: false


  componentWillUnmount: =>
    @xhr?.abort()


  render: =>
    return null if @props.user.is_bot

    div className: bn,
      @renderSetDefault()
      ul className: "#{bn}__items",
        for mode in BeatmapHelper.modes
          linkClass = 'game-mode-link'
          linkClass += ' game-mode-link--active' if mode == @props.currentMode

          li
            className: "#{bn}__item"
            key: mode
            a
              className: linkClass
              href: laroute.route 'users.show',
                user: @props.user.id
                mode: mode
              osu.trans "beatmaps.mode.#{mode}"
              if @props.user.playmode == mode
                span
                  className: 'game-mode-link__icon'
                  title: osu.trans('users.show.edit.default_playmode.is_default_tooltip')
                  ' '
                  span className: 'fas fa-star'


  renderSetDefault: =>
    if @props.withEdit && @props.user.playmode != @props.currentMode
      div
        className: "#{bn}__set-default hidden-xs"
        button
          className: 'profile-page-button'
          disabled: @state.settingDefault
          type: 'button'
          onClick: @setDefault
          dangerouslySetInnerHTML:
            __html:
              osu.trans 'users.show.edit.default_playmode.set',
                mode: "<strong>#{osu.trans "beatmaps.mode.#{@props.currentMode}"}</strong>"


  setDefault: =>
    @setState settingDefault: true

    @xhr =
      $.ajax laroute.route('account.update'),
        method: 'PUT'
        data:
          user:
            playmode: @props.currentMode
      .done (data) ->
        $.publish 'user:update', data
      .fail (xhr, status) ->
        return if status == 'abort'

        osu.emitAjaxError() xhr
      .always =>
        @setState settingDefault: false
