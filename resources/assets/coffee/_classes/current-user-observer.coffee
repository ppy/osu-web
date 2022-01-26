# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { pull } from 'lodash'
import { reaction } from 'mobx'
import core from 'osu-core-singleton'

class window.CurrentUserObserver
  constructor: ->
    @covers = document.getElementsByClassName('js-current-user-cover')
    @avatars = document.getElementsByClassName('js-current-user-avatar')
    @throttledReinit = _.throttle @reinit, 100

    $.subscribe 'user:update', @setData
    $(document).on 'turbolinks:load', @reinit
    $.subscribe 'osu:page:change', @throttledReinit
    $.subscribe 'user:followUserMapping:update', @updateFollowUserMapping

    # one time setup to monitor cover url variable. No disposer because nothing destroys this object.
    $ =>
      reaction((=> core.currentUser?.cover.url), @setCovers)


  reinit: =>
    @setAvatars()
    @setSentryUser()


  setAvatars: (elements) =>
    elements ?= @avatars

    bgImage = osu.urlPresence(currentUser.avatar_url) if currentUser.id?
    for el in elements
      el.style.backgroundImage = bgImage


  setCovers: =>
    bgImage = osu.urlPresence(core.currentUser.cover.url) if core.currentUser?
    for el in @covers
      el.style.backgroundImage = bgImage


  setData: (_e, data) =>
    window.currentUser = data

    @reinit()


  setSentryUser: ->
    return unless Sentry?

    Sentry.configureScope (scope) ->
      scope.setUser id: currentUser.id, username: currentUser.username


  updateFollowUserMapping: (_e, data) =>
    if data.following
      currentUser.follow_user_mapping.push(data.userId)
    else
      pull(currentUser.follow_user_mapping, data.userId)

    core.currentUser.follow_user_mapping = currentUser.follow_user_mapping

    $.publish 'user:followUserMapping:refresh'
