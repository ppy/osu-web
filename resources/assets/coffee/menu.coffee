###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
class @Menu
  $menuLink: (id) -> $(".js-menu[data-menu-target#{"='#{id}'" if id}]")

  constructor: ->
    @debouncedRefresh = _.debounce @refresh, 150
    $(document).on 'mouseenter', '.js-menu', @onEnter
    $(document).on 'mouseleave', '.js-menu', @onLeave


  parentMenuId: ($child) ->
    $child.closest('[data-menu-id]').attr('data-menu-id')


  currentTree: =>
    return [] unless @currentMenu

    traverseId = @currentMenu
    currentTree = [traverseId]

    while true
      traverseId = @parentMenuId @$menuLink(traverseId)

      if traverseId
        currentTree.push traverseId
      else
        break

    currentTree


  onEnter: (e) =>
    e.stopPropagation()
    $link = $(e.currentTarget)
    @currentMenu = $link.attr('data-menu-target')
    @currentMenu ||= @parentMenuId $link

    @debouncedRefresh()


  onLeave: (e) =>
    @currentMenu = null
    @debouncedRefresh()


  refresh: =>
    menus = document.querySelectorAll('.js-menu[data-menu-id]')

    currentTree = @currentTree()

    for menu in menus
      menuId = menu.getAttribute('data-menu-id')

      if currentTree.indexOf(menuId) == -1
        fade.out menu
        @$menuLink(menuId).removeClass('js-menu--active')

      else
        fade.in menu, 'flex'
        @$menuLink(menuId).addClass('js-menu--active')
