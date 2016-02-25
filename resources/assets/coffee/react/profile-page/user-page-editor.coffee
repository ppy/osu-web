###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
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
  componentDidMount: =>
    @refs.body.selectionStart = @props.userPage.selection[0]
    @refs.body.selectionEnd = @props.userPage.selection[1]
    @refs.body.focus()


  componentWillUnmount: =>
    $.publish 'user:page:update',
      selection: [@refs.body.selectionStart, @refs.body.selectionEnd]


  _reset: =>
    $.publish 'user:page:update',
      raw: @props.userPage.initialRaw

    @refs.body.focus()


  _cancel: =>
    $.publish 'user:page:update',
      editing: false
      raw: @props.userPage.initialRaw


  _save: (e) =>
    body = @props.userPage.raw
    osu.showLoadingOverlay()

    $.ajax Url.pageAccount,
      method: 'PUT'
      dataType: 'json'
      data:
        body: body
    .done (data) ->
      $.publish 'user:page:update',
        html: data.html
        editing: false
        raw: body
        initialRaw: body
    .always osu.hideLoadingOverlay


  _change: (e) =>
    $.publish 'user:page:update',
      raw: e.target.value


  render: =>
    el 'form', null,
      el 'textarea',
        className: 'flex-full profile-page-editor-body'
        name: 'body'
        value: @props.userPage.raw
        onChange: @_change
        placeholder: Lang.get('users.show.page.placeholder')
        ref: 'body'

      el 'div', className: 'post-editor__footer post-editor__footer--profile-page',
        el 'div', dangerouslySetInnerHTML:
          __html: postEditorToolbar.html

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
