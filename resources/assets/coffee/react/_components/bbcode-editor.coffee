# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { button, div, form, i, label, option, select, span, textarea } from 'react-dom-factories'
el = React.createElement

export class BbcodeEditor extends React.Component
  componentDidMount: =>
    @sizeSelect.value = ''
    @body.selectionEnd = 0
    @body.focus()


  render: =>
    blockClass = osu.classWithModifiers('bbcode-editor', @props.modifiers)
    blockClass += ' js-bbcode-preview--form'

    form
      className: blockClass
      'data-state': 'write'
      div className: 'bbcode-editor__content',
        textarea
          className: 'bbcode-editor__body js-bbcode-preview--body'
          name: 'body'
          placeholder: @props.placeholder
          defaultValue: @props.rawValue
          disabled: @props.disabled
          onKeyDown: @onKeyDown
          ref: @setBody

        div className: 'bbcode-editor__preview',
          div className: 'forum-post-content js-bbcode-preview--preview'

        div className: 'bbcode-editor__buttons-bar',
          div className: 'bbcode-editor__buttons bbcode-editor__buttons--toolbar',
            @renderToolbar()

          div className: 'bbcode-editor__buttons bbcode-editor__buttons--actions',
            div className: 'bbcode-editor__button bbcode-editor__button--cancel',
              @actionButton @_cancel, osu.trans('common.buttons.cancel')
            div className: 'bbcode-editor__button bbcode-editor__button--hide-on-write',
              @renderPreviewHideButton()
            div className: 'bbcode-editor__button bbcode-editor__button--hide-on-preview',
              @renderPreviewShowButton()
            div className: 'bbcode-editor__button',
              @actionButton @_save, osu.trans('common.buttons.save'), 'forum-primary'


  actionButton: (action, title, modifier = 'forum-secondary') =>
    button
      className: "btn-osu-big btn-osu-big--#{modifier}"
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


  _save: (event) =>
    @sendOnChange(event: event, type: 'save')


  sendOnChange: ({event, type}) =>
    @props.onChange?(
      event: event
      type: type
      value: @body.value
      hasChanged: @body.value != @props.rawValue
    )


  renderPreviewHideButton: ->
    button
      type: 'button'
      className: 'js-bbcode-preview--hide btn-osu-big btn-osu-big--forum-secondary'
      disabled: @props.disabled
      osu.trans('forum.topic.create.preview_hide')


  renderPreviewShowButton: ->
    button
      type: 'button'
      className: 'js-bbcode-preview--show btn-osu-big btn-osu-big--forum-secondary'
      disabled: @props.disabled
      osu.trans('forum.topic.create.preview')


  renderToolbar: =>
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
