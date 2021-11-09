# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import ExtraHeader from 'profile-page/extra-header'
import UserPageEditor from 'profile-page/user-page-editor'
import * as React from 'react'
import { a, button, div, span, p } from 'react-dom-factories'
import StringWithComponent from 'string-with-component'
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
            className: 'btn-circle btn-circle--page-toggle'
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
      p
        className: 'profile-extra-user-page__new-content'
        button
          type: 'button'
          className: 'btn-osu-big btn-osu-big--user-page-edit'
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
              link: a
                href: laroute.route('store.products.show', product: 'supporter-tag')
                target: '_blank'
                osu.trans 'users.show.page.restriction_info.link'
            pattern: osu.trans 'users.show.page.restriction_info._'


  pageShow: =>
    div
      className: 'js-audio--group'
      dangerouslySetInnerHTML:
        __html: @props.userPage.html
