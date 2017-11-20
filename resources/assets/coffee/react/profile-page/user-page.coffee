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

{button, div, span, p} = ReactDOMFactories
el = React.createElement

class ProfilePage.UserPage extends React.Component
  render: =>
    div className: 'page-extra',
      el ProfilePage.ExtraHeader, name: @props.name, withEdit: @props.withEdit

      if !@props.userPage.editing && @props.withEdit && @props.userPage.html != ''
        div className: 'page-extra__actions',
          div className: 'page-extra__actions__action',
            button
              type: 'button'
              className: 'btn-circle'
              onClick: @editStart
              span className: 'btn-circle__content',
                el Icon, name: 'edit'
          div className: 'page-extra__actions__action',
            button
              type: 'button'
              className: 'btn-circle'
              onClick: @delete
              span className: 'btn-circle__content',
                el Icon, name: 'trash'

      if @props.userPage.editing
        el ProfilePage.UserPageEditor, userPage: @props.userPage
      else if @props.withEdit && @props.userPage.html == ''
        @pageNew()
      else
        @pageShow()


  editStart: ->
    $.publish 'user:page:update', editing: true


  delete: (e) ->
    LoadingOverlay.show

    $.ajax laroute.route('account.page.destroy'),
      method: 'DELETE'
    .done ->
      $.publish 'user:page:update',
        html: ''
        editing: false
        raw: ''
        initialRaw: ''
    .fail osu.emitAjaxError(e.target)
    .always LoadingOverlay.hide


  pageNew: =>
    div className: 'text-center',
      button
        className: 'profile-extra-user-page__new-content   btn-osu btn-osu--lite btn-osu--profile-page-edit'
        onClick: @editStart
        disabled: !@props.user.isSupporter
        osu.trans 'users.show.page.edit_big'

      p className: 'profile-extra-user-page__new-content profile-extra-user-page__new-content--icon',
        el Icon, name: 'pencil-square-o'

      p
        className: 'profile-extra-user-page__new-content'
        dangerouslySetInnerHTML:
          __html: osu.trans 'users.show.page.description'

      if !@props.user.isSupporter
        p
          className: 'profile-extra-user-page__new-content'
          dangerouslySetInnerHTML:
            __html: osu.trans 'users.show.page.restriction_info'


  pageShow: =>
    div dangerouslySetInnerHTML:
      __html: @props.userPage.html
