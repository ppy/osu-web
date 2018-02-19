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

class @Menu
  constructor: ->
    @menuTimeout = 150

    $(document).on 'touchstart', '.js-menu', @onTouchStart
    $(document).on 'mouseenter', '.js-menu', @onMouseEnter
    $(document).on 'mouseleave', '.js-menu', @onMouseLeave
    $(document).on 'touchstart', @onGlobalTouchstart
    $(document).on 'turbolinks:load', @refresh


  $menuLink: (id) -> $(".js-menu[data-menu-target#{if id then "='#{id}'" else ''}]")


  closestMenuId: ($child) ->
    $child.closest('[data-menu-id]').attr('data-menu-id')

  defaultMenu: =>
    document.querySelector('.js-menu[data-menu-default="1"]')?.dataset?.menuTarget


  parentsMenuId: ($child) ->
    $child.parents('[data-menu-id]').attr('data-menu-id')


  currentTree: =>
    return [] unless @currentMenu

    traverseId = @currentMenu
    currentTree = [traverseId]

    while true
      traverseId = @closestMenuId @$menuLink(traverseId)

      if traverseId
        currentTree.push traverseId
      else
        break

    currentTree


  onGlobalTouchstart: (e) =>
    return unless @currentMenu

    closest = e.target
    while closest
      return if closest.classList.contains('js-menu')
      closest = closest.parentElement

    @hideMenu()


  onTouchStart: (e) =>
    target = e.currentTarget.getAttribute('data-menu-target')
    return unless target

    $target = $(e.currentTarget)
    e.preventDefault()

    Timeout.clear @refreshTimeout
    @refreshTimeout = Timeout.set @menuTimeout, =>
      @currentMenu =
        if @currentMenu == target
          @closestMenuId $target
        else
          target
      @refresh()



  onMouseEnter: (e) =>
    link = e.currentTarget

    Timeout.clear @refreshTimeout
    @refreshTimeout = Timeout.set @menuTimeout, =>
      @currentMenu = link.dataset.menuTarget
      @currentMenu ?= @closestMenuId $(link)
      @refresh()



  onMouseLeave: (e) =>
    $target = $(e.currentTarget)

    Timeout.clear @refreshTimeout
    @refreshTimeout = Timeout.set @menuTimeout, =>
      @currentMenu = @parentsMenuId $target
      @refresh()


  hideMenu: =>
    Timeout.clear @refreshTimeout
    @refreshTimeout = Timeout.set @menuTimeout, =>
      @currentMenu = null
      @refresh()


  refresh: =>
    @currentMenu ?= @defaultMenu()
    menus = document.querySelectorAll('.js-menu[data-menu-id]')

    currentTree = @currentTree()
    $.publish 'menu:current', @currentMenu

    for menu in menus
      menuId = menu.getAttribute('data-menu-id')

      if currentTree.indexOf(menuId) == -1
        Fade.out menu
        @$menuLink(menuId).removeClass('js-menu--active')
      else
        Fade.in menu
        @$menuLink(menuId).addClass('js-menu--active')
        $(menu).trigger 'menu:showing'
