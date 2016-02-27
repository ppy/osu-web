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
class @Menu
  $menuLink: (id) -> $(".js-menu[data-menu-target#{if id then "='#{id}'" else ''}]")

  constructor: ->
    @debouncedRefresh = _.debounce @refresh, 150
    $(document).on 'touchstart', '.js-menu', @onTouchStart
    $(document).on 'mouseenter', '.js-menu', @onMouseEnter
    $(document).on 'mouseleave', '.js-menu', @onMouseLeave
    $(document).on 'touchstart', @onGlobalTouchstart


  closestMenuId: ($child) ->
    $child.closest('[data-menu-id]').attr('data-menu-id')

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

    e.preventDefault()
    e.stopPropagation()

    @currentMenu =
      if @currentMenu == target
        @closestMenuId $(e.currentTarget)
      else
        target

    @debouncedRefresh()


  onMouseEnter: (e) =>
    e.stopPropagation()
    $link = $(e.currentTarget)
    @currentMenu = $link.attr('data-menu-target')
    @currentMenu ||= @closestMenuId $link

    @debouncedRefresh()


  onMouseLeave: (e) =>
    @currentMenu = @parentsMenuId $(e.currentTarget)
    @debouncedRefresh()


  hideMenu: =>
    @currentMenu = null
    @debouncedRefresh()


  refresh: =>
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
