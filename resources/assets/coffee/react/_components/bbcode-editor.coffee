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
import { button, div, em, form, i, label, option, select, span, strong, textarea } from 'react-dom-factories'
el = React.createElement

export class BBCodeEditor extends React.Component
  componentDidMount: =>
    @sizeSelect.value = ''
    @body.selectionEnd = 0
    @body.focus()


  render: =>
    blockClass = 'post-editor'
    blockClass += " post-editor--#{modifier}" for modifier in @props.modifiers ? []

    form className: blockClass,
      textarea
        className: 'post-editor__textarea'
        name: 'body'
        placeholder: @props.placeholder
        defaultValue: @props.rawValue
        disabled: @props.disabled
        onKeyDown: @onKeyDown
        ref: @setBody

      div className: 'post-editor__footer',
        div className: 'post-editor-footer',
          div className: 'post-editor-footer__col post-editor-footer__col--toolbar',
            div className: 'post-box-toolbar',
              @toolbarButton 'bold', i(className: 'fas fa-bold')
              @toolbarButton 'italic', i(className: 'fas fa-italic')
              @toolbarButton 'strikethrough', i(className: 'fas fa-strikethrough')
              @toolbarButton 'heading', i(className: 'fas fa-heading')
              @toolbarButton 'link', i(className: 'fas fa-link')
              @toolbarButton 'spoilerbox', i(className: 'fas fa-barcode')
              @toolbarButton 'list-numbered', i(className: 'fas fa-list-ol')
              @toolbarButton 'list', i(className: 'fas fa-list')
              @toolbarButton 'image', i(className: 'fas fa-image')

              label
                className: 'bbcode-size-select'
                title: osu.trans('bbcode.size._')

                span className: "bbcode-size-select__label", osu.trans('bbcode.size._')
                i className: "fas fa-chevron-down"
                select
                  className: 'bbcode-size-select__select js-bbcode-btn--size'
                  disabled: @props.disabled
                  ref: @setSizeSelect
                  option value: '50', osu.trans('bbcode.size.tiny')
                  option value: '85', osu.trans('bbcode.size.small')
                  option value: '100', osu.trans('bbcode.size.normal')
                  option value: '150', osu.trans('bbcode.size.large')

          div className: 'post-editor-footer__col post-editor-footer__col--actions',
            @actionButton @_cancel, osu.trans('common.buttons.cancel')
            @actionButton @_reset, osu.trans('common.buttons.reset')
            @actionButton @_save, osu.trans('common.buttons.save')


  actionButton: (action, title) =>
    button
      className: 'btn-osu btn-osu--post-editor btn-osu-default'
      disabled: @props.disabled
      type: 'button'
      onClick: action
      title


  toolbarButton: (name, content) =>
    button
      className: "btn-circle btn-circle--bbcode js-bbcode-btn--#{name}"
      disabled: @props.disabled
      title: osu.trans("bbcode.#{_.snakeCase name}")
      type: 'button'

      span className: 'btn-circle__content', content


  setBody: (element) =>
    @body = element


  setSizeSelect: (element) =>
    @sizeSelect = element


  onKeyDown: (e) =>
    e.keyCode == 27 && @_cancel()


  _cancel: (event) =>
    return if @body.value != @props.rawValue && !confirm(osu.trans('common.confirmation_unsaved'))

    @body.value = @props.rawValue
    @sendOnChange(event: event, type: 'cancel')


  _reset: (event) =>
    @body.value = @props.rawValue
    @sendOnChange(event: event, type: 'reset')
    @body.focus()


  _save: (event) =>
    @sendOnChange(event: event, type: 'save')


  sendOnChange: ({event, type}) =>
    @props.onChange?(
      event: event
      type: type
      value: @body.value
      hasChanged: @body.value != @props.rawValue
    )
