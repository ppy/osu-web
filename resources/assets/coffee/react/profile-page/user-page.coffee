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

import { ExtraHeader } from './extra-header'
import { UserPageEditor } from './user-page-editor'
import * as React from 'react'
import { a, button, div, span, p } from 'react-dom-factories'
import { StringWithComponent } from 'string-with-component'
el = React.createElement

export class UserPage extends React.Component
  render: =>
    isBlank = @props.userPage.initialRaw.trim() == ''
    canEdit = @props.withEdit || window.currentUser.is_moderator || window.currentUser.is_admin

    div className: 'page-extra page-extra--userpage',
      el ExtraHeader, name: @props.name, withEdit: @props.withEdit

      if !@props.userPage.editing && canEdit && !isBlank
        div className: 'page-extra__actions',
          button
            type: 'button'
            title: osu.trans('users.show.page.button')
            className: 'profile-page-toggle'
            onClick: @editStart
            span className: 'fas fa-pencil-alt'

      if @props.userPage.editing
        el UserPageEditor, userPage: @props.userPage, user: @props.user
      else
        div className: 'page-extra__content-overflow-wrapper-outer u-fancy-scrollbar',
          if @props.withEdit && isBlank
            @pageNew()
          else
            div className: 'page-extra__content-overflow-wrapper-inner',
              @pageShow()


  editStart: ->
    $.publish 'user:page:update', editing: true


  pageNew: =>
    div className: 'profile-extra-user-page profile-extra-user-page--new',
      button
        className: 'profile-extra-user-page__new-content  btn-osu btn-osu--lite btn-osu--profile-page-edit'
        onClick: @editStart
        disabled: !@props.user.has_supported
        osu.trans 'users.show.page.edit_big'

      p className: 'profile-extra-user-page__new-content profile-extra-user-page__new-content--icon',
        span className: 'fas fa-edit'

      p
        className: 'profile-extra-user-page__new-content'
        dangerouslySetInnerHTML:
          __html: osu.trans 'users.show.page.description'

      if !@props.user.has_supported
        p
          className: 'profile-extra-user-page__new-content'
          el StringWithComponent,
            mappings:
              ':link': a
                href: laroute.route('store.products.show', product: 'supporter-tag')
                key: 'link'
                target: '_blank'
                osu.trans 'users.show.page.restriction_info.link'
            pattern: osu.trans 'users.show.page.restriction_info._'


  pageShow: =>
    div dangerouslySetInnerHTML:
      __html: @props.userPage.html
