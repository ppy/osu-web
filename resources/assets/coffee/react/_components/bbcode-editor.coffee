###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

{button, div, em, form, i, label, option, select, span, strong, textarea} = ReactDOMFactories

class @BBCodeEditor extends React.Component
  componentDidMount: =>
    if @props.selection?.range
      @body.selectionStart = @props.selection.range[0]
      @body.selectionEnd = @props.selection.range[1]

    @body.focus()


  componentWillUnmount: =>
    @props.onSelectionUpdate?(range: [@body.selectionStart, @body.selectionEnd])


  onKeyDown: (e) =>
    e.keyCode == 27 && @_cancel()


  _cancel: =>
    @body.value = @props.rawValue
    @props.onChange?(type: 'cancel', value: @props.rawValue)


  _reset: =>
    @body.value = @props.rawValue
    @props.onChange?(type: 'reset', value: @props.rawValue)
    @body.focus()


  _save: =>
    @props.onChange?(
      type: 'save'
      value: @body.value
      hasChanged: @body.value != @props.rawValue
    )


  render: ->
    form className: 'post-editor',
      textarea
        className: 'post-editor__textarea'
        name: 'body'
        defaultValue: @props.rawValue
        disabled: @props.disabled
        onKeyDown: @onKeyDown
        ref: (element) => @body = element

      div className: 'post-editor__footer',
        div className: 'post-editor__toolbar',
          button
            className: 'btn-circle btn-circle--bbcode js-bbcode-btn--bold'
            disabled: @props.disabled
            title: osu.trans('bbcode.bold')
            type: 'button',

            span className: 'btn-circle__content',
              strong null, 'B'

          button
            className: 'btn-circle btn-circle--bbcode js-bbcode-btn--italic'
            disabled: @props.disabled
            title: osu.trans('bbcode.italic')
            type: 'button',

            span className: 'btn-circle__content',
              em null, 'I'

          button
            className: 'btn-circle btn-circle--bbcode js-bbcode-btn--strikethrough'
            disabled: @props.disabled
            title: osu.trans('bbcode.strikethrough')
            type: 'button',

            span className: 'btn-circle__content',
              i className: 'fa fa-strikethrough'

          button
            className: 'btn-circle btn-circle--bbcode js-bbcode-btn--heading'
            disabled: @props.disabled
            title: osu.trans('bbcode.heading')
            type: 'button',

            span className: 'btn-circle__content',
              span null, 'H'

          button
            className: 'btn-circle btn-circle--bbcode js-bbcode-btn--link'
            disabled: @props.disabled
            title: osu.trans('bbcode.link')
            type: 'button',

            span className: 'btn-circle__content',
              i className: 'fa fa-link'

          button
            className: 'btn-circle btn-circle--bbcode js-bbcode-btn--spoilerbox'
            disabled: @props.disabled
            title: osu.trans('bbcode.spoilerbox')
            type: 'button',

            i className: 'fa fa-barcode'

          button
            className: 'btn-circle btn-circle--bbcode js-bbcode-btn--list-numbered'
            disabled: @props.disabled
            title: osu.trans('bbcode.list_numbered')
            type: 'button',

            span className: 'btn-circle__content',
              i className: 'fa fa-list-ol'

          button
            className: 'btn-circle btn-circle--bbcode js-bbcode-btn--list'
            disabled: @props.disabled
            title: osu.trans('bbcode.list')
            type: 'button',

            span className: 'btn-circle__content',
              i className: 'fa fa-list'

          button
            className: 'btn-circle btn-circle--bbcode js-bbcode-btn--image'
            disabled: @props.disabled
            title: osu.trans('bbcode.image')
            type: 'button',

            span className: 'btn-circle__content',
              i className: 'fa fa-image'

          label
            className: 'bbcode-size-select'
            title: osu.trans('bbcode.size._'),

            span className: "bbcode-size-select__label", osu.trans('bbcode.size._')
            i className: "fa fa-chevron-down"
            select
              className: 'bbcode-size-select__select js-bbcode-btn--size'
              disabled: @props.disabled
              defaultValue: '100',
              option value: '50', osu.trans('bbcode.size.tiny')
              option value: '85', osu.trans('bbcode.size.small')
              option value: '100', osu.trans('bbcode.size.normal')
              option value: '150', osu.trans('bbcode.size.large')

        div className: 'post-editor__actions',
          button
            className: 'btn-osu btn-osu--small btn-osu-default post-editor__action'
            disabled: @props.disabled
            type: 'button'
            onClick: @_cancel
            osu.trans('common.buttons.cancel')

          button
            className: 'btn-osu btn-osu--small btn-osu-default post-editor__action'
            disabled: @props.disabled
            type: 'button'
            onClick: @_reset
            osu.trans('common.buttons.reset')

          button
            className: 'btn-osu btn-osu--small btn-osu-default post-editor__action'
            disabled: @props.disabled
            type: 'button'
            onClick: @_save
            osu.trans('common.buttons.save')
