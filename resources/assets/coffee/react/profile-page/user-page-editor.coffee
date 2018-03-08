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

{div} = ReactDOMFactories
el = React.createElement

class ProfilePage.UserPageEditor extends React.Component
  componentDidMount: =>
    $(@body)
      .off 'bbcode:inserted'
      .on 'bbcode:inserted', @_change

    @body.selectionStart = @props.userPage.selection[0]
    @body.selectionEnd = @props.userPage.selection[1]
    @body.focus()


  componentWillUnmount: =>
    # FIXME: Doesn't work on page nagivation.
    #        Looks like the listener has gone when this is triggered.
    $.publish 'user:page:update',
      selection: [@body.selectionStart, @body.selectionEnd]


  render: =>
    el 'form', null,
      el 'textarea',
        className: 'profile-extra-user-page-editor'
        name: 'body'
        value: @props.userPage.raw
        onChange: @_change
        placeholder: osu.trans('users.show.page.placeholder')
        ref: @setBody

      el 'div', className: 'post-editor__footer post-editor__footer--profile-page',
        div
          className: 'post-editor__toolbar'
          dangerouslySetInnerHTML:
            __html: postEditorToolbar.html

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


  _change: (e) =>
    $.publish 'user:page:update',
      raw: e.currentTarget.value


  _reset: =>
    $.publish 'user:page:update',
      raw: @props.userPage.initialRaw

    @body.focus()


  _cancel: =>
    $.publish 'user:page:update',
      editing: false
      raw: @props.userPage.initialRaw


  _save: (e) =>
    body = @props.userPage.raw
    LoadingOverlay.show()

    $.ajax laroute.route('account.page'),
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
    .fail osu.emitAjaxError(e.target)
    .always LoadingOverlay.hide


  setBody: (el) =>
    @body = el
