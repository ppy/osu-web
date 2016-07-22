###
# Copyright 2015-2016 ppy Pty. Ltd.
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
class @CurrentUserObserver
  constructor: ->
    @currentUserCovers = document.getElementsByClassName('js-current-user-cover')

    @observer = new MutationObserver (mutations) =>
      for mutation in mutations
        for nodes in mutation.addedNodes
          for node in nodes
            if node.classList.has 'js-current-user-cover'
              @setCover node
            else
              @setCovers node.getElementsByClassName('js-current-user-cover')

    $.subscribe 'user:update', @setData
    $(document).on 'turbolinks:load', @initCovers


  initCovers: =>
    @setCovers()


  setCover: (el) =>
    url = if currentUser.id? then "url('#{currentUser.cover.url}')"

    el.style.backgroundImage = url


  setCovers: (elements) =>
    if !elements?
      elements = @currentUserCovers

    @setCover(el) for el in elements


  setData: (_e, data) =>
    window.currentUser = data

    @setCovers()
