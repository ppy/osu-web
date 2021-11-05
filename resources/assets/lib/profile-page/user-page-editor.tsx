# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import BbcodeEditor from 'bbcode-editor'
import * as React from 'react'
el = React.createElement

export class UserPageEditor extends React.PureComponent
  render: =>
    el BbcodeEditor,
      modifiers: ['profile-page']
      rawValue: @props.userPage.raw
      placeholder: osu.trans('users.show.page.placeholder')
      onChange: @onChange


  onChange: ({event, type, value}) =>
    switch type
      when 'cancel'
        @cancel()
      when 'save'
        @save({event, value})


  cancel: =>
    $.publish 'user:page:update',
      editing: false


  save: ({event, value}) =>
    return @cancel() if value == @props.userPage.raw

    LoadingOverlay.show()

    $.ajax laroute.route('users.page', user: @props.user.id),
      method: 'PUT'
      dataType: 'json'
      data:
        body: value
    .done (data) ->
      $.publish 'user:page:update',
        html: data.html
        editing: false
        raw: value
        initialRaw: value
    .fail osu.emitAjaxError(event.target)
    .always LoadingOverlay.hide
