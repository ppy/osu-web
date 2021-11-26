# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { gameModes } from 'interfaces/game-mode'
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
        for mode in gameModes
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
      $.ajax laroute.route('account.options'),
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
