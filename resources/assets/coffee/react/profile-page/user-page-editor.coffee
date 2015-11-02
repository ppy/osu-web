###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License as published by
# the Free Software Foundation, version 3 of the License.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
el = React.createElement

class ProfilePage.UserPageEditor extends React.Component
  constructor: (props) ->
    super props
    @state = raw: @props.userPage.raw


  componentDidMount: =>
    body = @_body()
    $(body).on 'change', @_change
    body.selectionStart = @props.userPage.selection[0]
    body.selectionEnd = @props.userPage.selection[1]
    @_focus()


  componentWillUnmount: =>
    body = @_body()
    $(body).off 'change', @_change

    $.publish 'user:page:update',
      raw: @state.raw
      selection: [body.selectionStart, body.selectionEnd]


  _body: => React.findDOMNode(@refs.body)


  _focus: => @_body().focus()


  _reset: (_e, callback) =>
    if typeof callback != 'function'
      callback = @_focus

    @setState raw: @props.userPage.initialRaw, callback


  _cancel: =>
    @_reset null, ->
      $.publish 'user:page:update', editing: false


  _save: (e) =>
    body = @state.raw
    osu.showLoadingOverlay()

    $.ajax window.changePageUrl,
      method: 'PUT'
      dataType: 'json'
      data: body: body
    .done (data) ->
      $.publish 'user:page:update',
        html: data.html
        editing: false
        raw: body
        initialRaw: body
    .always osu.hideLoadingOverlay


  _change: (e) => @setState(raw: e.target.value)


  render: =>
    el 'form', null,
      el 'textarea',
        className: 'flex-full profile-page-editor-body'
        name: 'body'
        value: @state.raw
        onChange: @_change
        placeholder: Lang.get('users.show.page.placeholder')
        ref: 'body'

      el 'div', className: 'post-editor__footer post-editor__footer--profile-page',
        el 'div', dangerouslySetInnerHTML:
          __html: osu.parseJson('json-post-editor-toolbar').html

        el 'div', className: 'post-editor__actions',
          el 'button',
            className: 'btn-osu btn-osu--small btn-osu-default post-editor__action'
            type: 'button'
            onClick: @_cancel
            Lang.get('common.buttons.cancel')

          el 'button',
            className: 'btn-osu btn-osu--small btn-osu-default post-editor__action'
            type: 'button'
            onClick: @_reset
            Lang.get('common.buttons.reset')

          el 'button',
            className: 'btn-osu btn-osu--small btn-osu-default post-editor__action'
            type: 'button'
            onClick: @_save
            Lang.get('common.buttons.save')
