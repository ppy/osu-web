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

import { BBCodeEditor } from 'bbcode-editor'
import * as React from 'react'
el = React.createElement

export class UserPageEditor extends React.PureComponent
  render: =>
    el BBCodeEditor,
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
