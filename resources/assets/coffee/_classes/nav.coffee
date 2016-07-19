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
class @Nav
  constructor: ->
    $(document).on 'click mouseenter', '.js-nav-popup', @showPopup
    $(document).on 'mouseleave', '.js-nav-popup', @gracefulHidePopup
    $(document).on 'click', '.js-nav-switch', @switchMode
    $(document).on 'click', @hidePopup

    @popup = document.getElementsByClassName('js-nav-popup--popup')
    @menus = document.getElementsByClassName('js-nav-switch--menu')
    @switches = document.getElementsByClassName('js-nav-switch')


  available: => @popup[0]?


  currentMode: (newMode) =>
    return if !@available()

    if newMode? && newMode != @popup[0].dataset.currentMode
      @popup[0].dataset.currentMode = newMode
      @syncMode()

    @popup[0].dataset.currentMode ?= 'default'


  gracefulHidePopup: =>
    return if @currentMode() != 'default'
    @hidePopup()


  hidePopup: (e) =>
    return if !@available()
    return if !Fade.isVisible(@popup[0])

    if e?
      return if $(e.target).closest('.js-nav-popup').length != 0

    Fade.out @popup[0]
    @switchMode()


  showPopup: =>
    return if !@available()

    Fade.in @popup[0]


  switchMode: (e) =>
    if e?
      e.preventDefault()
      e.stopPropagation()

      mode = e.currentTarget.dataset.navMode

      mode = null if @currentMode() == mode

    mode ?= 'default'

    @currentMode(mode)


  syncMode: =>
    activeClass = 'js-nav-switch--active'

    for menu in @menus
      if menu.dataset.navMode == @currentMode()
        menu.classList.add activeClass
      else
        menu.classList.remove activeClass

    for link in @switches
      if link.dataset.navMode == @currentMode()
        link.classList.add activeClass
      else
        link.classList.remove activeClass

    # Somehow broken using no delay when there's animation
    osu.timeout 100, => $('.js-nav-autofocus').focus()
