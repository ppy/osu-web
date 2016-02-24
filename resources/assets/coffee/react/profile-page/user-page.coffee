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

class ProfilePage.UserPage extends React.Component
  editStart: (e) ->
    e.preventDefault()
    $.publish 'user:page:update', editing: true


  pageNew: =>
    canCreate = @props.withEdit and @props.user.isSupporter

    el 'div', className: 'text-center',
      el 'button',
        className: 'profile-page-new-content btn-osu btn-osu--lite btn-osu--profile-page-edit'
        onClick: @editStart
        disabled: !canCreate
        Lang.get('users.show.page.edit_big')

      el 'p', className: 'profile-page-new-content profile-page-new-icon',
        el 'i', className: 'fa fa-pencil-square-o'

      el 'p',
        className: 'profile-page-new-content'
        dangerouslySetInnerHTML:
          __html: Lang.get('users.show.page.description')

      if !@props.user.isSupporter
        el 'p',
          className: 'profile-page-new-content'
          dangerouslySetInnerHTML:
            __html: Lang.get('users.show.page.restriction_info')

  pageShow: =>
    el 'div', dangerouslySetInnerHTML:
      __html: @props.userPage.html

  render: =>
    withEditButton = @props.withEdit

    if withEditButton && @props.userPage.html == ''
      withEditButton = false
      page = @pageNew()
    else if @props.userPage.editing
      page = el ProfilePage.UserPageEditor, userPage: @props.userPage
    else
      page = @pageShow()

    el 'div', className: 'profile-extra',
      @props.header

      if withEditButton && !@props.userPage.editing
        el 'div', className: 'profile-extra__actions',
          el 'div', className: 'forum-post-actions',
            el 'a',
              className: 'forum-post-actions__action'
              href: '#'
              onClick: @editStart
              el 'i', className: 'fa fa-edit'
      page
