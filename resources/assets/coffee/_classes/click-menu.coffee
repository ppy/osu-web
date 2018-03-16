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

class @ClickMenu
  constructor: ->
    $(document).on 'click', '.js-click-menu', @toggle
    $(document).on 'click', @hide
    addEventListener 'turbolinks:load', @restoreSaved
    addEventListener 'turbolinks:before-cache', @saveCurrent


  hide: (e) =>
    return if osu.popupShowing()
    return if !@current?
    return if $(e.target).closest('.js-click-menu').length > 0

    @show()


  restoreSaved: =>
    @show document.body.dataset.clickMenuCurrent


  saveCurrent: =>
    document.body.dataset.clickMenuCurrent = @current


  show: (target) =>
    found = false

    for menu in document.querySelectorAll('.js-click-menu[data-click-menu-id]')
      if menu.dataset.clickMenuId == target
        found = true
        Fade.in menu
      else
        Fade.out menu

    for link in document.querySelectorAll('.js-click-menu[data-click-menu-target]')
      if found && link.dataset.clickMenuTarget == target
        link.classList.add 'js-click-menu--active'
      else
        link.classList.remove 'js-click-menu--active'

    @current = if found then target

    $.publish 'click-menu:current', @current


  toggle: (e) =>
    menu = e.currentTarget

    return if @current? && menu.dataset.clickMenuId == @current

    target = menu.dataset.clickMenuTarget
    next = target if @current != target

    @show next
