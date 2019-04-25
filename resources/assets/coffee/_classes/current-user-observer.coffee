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

class @CurrentUserObserver
  constructor: ->
    @covers = document.getElementsByClassName('js-current-user-cover')
    @avatars = document.getElementsByClassName('js-current-user-avatar')

    $.subscribe 'user:update', @setData
    $(document).on 'turbolinks:load', @reinit
    $.subscribe 'osu:page:change', @reinit


  reinit: =>
    @setAvatars()
    @setCovers()
    @setSentryUser()


  setAvatars: (elements) =>
    elements ?= @avatars

    bgImage = osu.urlPresence(currentUser.avatar_url) if currentUser.id?
    for el in elements
      el.style.backgroundImage = bgImage


  setCovers: (elements) =>
    elements ?= @covers

    bgImage = osu.urlPresence(currentUser.cover_url) if currentUser.id?
    for el in elements
      el.style.backgroundImage = bgImage


  setData: (_e, data) =>
    window.currentUser = data

    @reinit()


  setSentryUser: ->
    return unless Sentry?

    Sentry.configureScope (scope) ->
      scope.setUser id: currentUser.id, username: currentUser.username
