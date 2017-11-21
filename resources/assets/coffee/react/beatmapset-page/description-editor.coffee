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

{button, div, em, i, label, option, select, span, strong} = ReactDOMFactories
el = React.createElement

class BeatmapsetPage.DescriptionEditor extends React.Component
  constructor: (props) ->
    super props

    @state =
      rawValue: @props.rawValue


  componentDidMount: =>
    # stuff


  componentWillUnmount: =>
    # stuff

  onInput: (_e) =>
    @setState rawValue: @refs.body.value


  _cancel: =>
    @refs.body.value = @props.rawValue
    @setState rawValue: @props.rawValue
    @props.onCancel(value: @props.rawValue) if @props.onCancel


  _reset: =>
    @refs.body.value = @props.rawValue
    @setState rawValue: @props.rawValue
    @props.onReset(value: @props.rawValue) if @props.onReset


  _save: =>
    @props.onSave(value: @state.rawValue) if @props.onSave


  render: =>
    el 'form', null,
      el 'textarea',
        className: 'post-editor'
        name: 'body'
        value: @state.rawValue
        onChange: @onInput # binds to oninput, not onchange
        placeholder: 'blah'
        ref: 'body'

      el 'div', className: 'post-editor__footer post-editor__footer--profile-page',
        div
          className: 'post-editor__toolbar',
          div className: 'post-box-toolbar',
            button
              className: 'btn-circle btn-circle--bbcode js-bbcode-btn--bold'
              onClick: @onInput
              title: osu.trans('bbcode.bold')
              type: 'button',

              span className: 'btn-circle__content',
                strong null, 'B'

            button
              className: 'btn-circle btn-circle--bbcode js-bbcode-btn--italic'
              onClick: @onInput
              title: osu.trans('bbcode.italic')
              type: 'button',

              span className: 'btn-circle__content',
                em null, 'I'

            button
              className: 'btn-circle btn-circle--bbcode js-bbcode-btn--strikethrough'
              onClick: @onInput
              title: osu.trans('bbcode.strikethrough')
              type: 'button',

              span className: 'btn-circle__content',
                i className: 'fa fa-strikethrough'

            button
              className: 'btn-circle btn-circle--bbcode js-bbcode-btn--heading'
              onClick: @onInput
              title: osu.trans('bbcode.heading')
              type: 'button',

              span className: 'btn-circle__content',
                span null, 'H'

            button
              className: 'btn-circle btn-circle--bbcode js-bbcode-btn--link'
              onClick: @onInput
              title: osu.trans('bbcode.link')
              type: 'button',

              span className: 'btn-circle__content',
                i className: 'fa fa-link'

            button
              className: 'btn-circle btn-circle--bbcode js-bbcode-btn--spoilerbox'
              onClick: @onInput
              title: osu.trans('bbcode.spoilerbox')
              type: 'button',

              i className: 'fa fa-barcode'

            button
              className: 'btn-circle btn-circle--bbcode js-bbcode-btn--list-numbered'
              onClick: @onInput
              title: osu.trans('bbcode.list_numbered')
              type: 'button',

              span className: 'btn-circle__content',
                i className: 'fa fa-list-ol'

            button
              className: 'btn-circle btn-circle--bbcode js-bbcode-btn--list'
              onClick: @onInput
              title: osu.trans('bbcode.list')
              type: 'button',

              span className: 'btn-circle__content',
                i className: 'fa fa-list'

            button
              className: 'btn-circle btn-circle--bbcode js-bbcode-btn--image'
              onClick: @onInput
              title: osu.trans('bbcode.image')
              type: 'button',

              span className: 'btn-circle__content',
                i className: 'fa fa-image'


            label
              className: 'bbcode-size-select'
              title: osu.trans('bbcode.size._'),

              span className: "bbcode-size-select__label", osu.trans('bbcode.size._'),
                i className: "fa fa-chevron-down"
                select
                  className: 'bbcode-size-select__select js-bbcode-btn--size'
                  onChange: @onInput
                  value: '100',
                  option value: '50', osu.trans('bbcode.size.tiny')
                  option value: '85', osu.trans('bbcode.size.small')
                  option value: '100', osu.trans('bbcode.size.normal')
                  option value: '150', osu.trans('bbcode.size.large')

        el 'div', className: 'post-editor__actions',
          el 'button',
            className: 'btn-osu btn-osu--small btn-osu-default post-editor__action'
            type: 'button'
            onClick: @_cancel
            osu.trans('common.buttons.cancel')

          el 'button',
            className: 'btn-osu btn-osu--small btn-osu-default post-editor__action'
            type: 'button'
            onClick: @_reset
            osu.trans('common.buttons.reset')

          el 'button',
            className: 'btn-osu btn-osu--small btn-osu-default post-editor__action'
            type: 'button'
            onClick: @_save
            osu.trans('common.buttons.save')
