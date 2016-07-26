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
    $(document).on 'mouseenter', '.js-nav-popup', @showPopup
    $(document).on 'mouseleave', '.js-nav-popup', @gracefulHidePopup
    $(document).on 'click', @hidePopup

    $(document).on 'click', '.js-nav-toggle', @toggleMenu
    $(document).on 'click', '.js-nav-switch', @switchMode
    $(window).on 'throttled-scroll throttled-resize', @repositionPopup

    @popup = document.getElementsByClassName('js-nav-popup--popup')
    @popupContainer = document.getElementsByClassName('js-nav-popup--container')
    @menus = document.getElementsByClassName('js-nav-switch--menu')
    @switches = document.getElementsByClassName('js-nav-switch')
    @floatBeacon = document.getElementsByClassName('js-nav-popup--beacon')


  autoFocus: (e, popup) =>
    if e?
      popup = e.currentTarget

    popup.getElementsByClassName('js-nav-auto-focus')[0]?.focus?()


  available: => @popup[0]?


  currentMode: (newMode) =>
    return if !@available()

    if newMode? && newMode != @popup[0].dataset.currentMode
      @popup[0].dataset.currentMode = newMode
      @syncMode()

    @popup[0].dataset.currentMode ?= 'default'


  floatPopup: (float) =>
    if float
      @popupContainer[0].style.position = 'fixed'
      @popupContainer[0].style.width = '100%'
      @popupContainer[0].classList.add 'u-nav-float'
    else
      @popupContainer[0].style.position = ''
      @popupContainer[0].classList.remove 'u-nav-float'


  gracefulHidePopup: =>
    return if @currentMode() != 'default'
    @hidePopup()


  hidePopup: (e) =>
    return if !@available()
    return if !@visible

    if e?
      return if $(e.target).closest('.js-nav-popup').length != 0

    Timeout.clear @hideTimeout
    @hideTimeout = Timeout.set 10, =>
      @visible = false
      @showAllMenu false
      @floatPopup false
      @currentMode('default')


  repositionPopup: =>
    return if !@available()
    return if !@visible

    beaconPosition = @floatBeacon[0].getBoundingClientRect()

    float = beaconPosition.bottom < 0
    @floatPopup float


  showAllMenu: (enable) =>
    for menu in @menus
      if enable
        menu.classList.add 'js-nav-switch--visible'
      else
        menu.classList.remove 'js-nav-switch--visible'


  toggleMenu: (e) =>
    e.preventDefault()
    e.stopPropagation()

    mode = e.currentTarget.dataset.navMode

    if @currentMode() == mode
      @hidePopup()
    else
      @currentMode mode
      @showPopup() unless @visible


  showPopup: =>
    return if !@available()

    Timeout.clear @hideTimeout
    @visible = true
    @showAllMenu true
    @repositionPopup()


  switchMode: (e) =>
    if e?
      e.preventDefault()

      mode = e.currentTarget.dataset.navMode
      mode = null if @currentMode() == mode

    mode ?= 'default'
    @currentMode(mode)


  syncMode: =>
    animateClass = 'js-nav-switch--animated'
    activeClass = 'js-nav-switch--active'

    [currentMode, currentSubMode] = @currentMode().split '/'

    for menu in @menus
      if @visible
        menu.classList.add animateClass
      else
        menu.classList.remove animateClass

      if menu.dataset.navMode == currentMode
        menu.classList.add activeClass

        for submenu in menu.getElementsByClassName('js-nav-popup--submenu')
          if !currentSubMode? || submenu.dataset.navSubMode == currentSubMode
            submenu.classList.remove 'hidden'
          else
            submenu.classList.add 'hidden'

        if menu.classList.contains 'js-nav-switch--animated'
          $(menu).one 'transitionend', @autoFocus
        else
          Timeout.set 0, => @autoFocus null, menu

      else
        menu.classList.remove activeClass

    for link in @switches
      isCurrent =
        link.dataset.navMode == currentMode &&
        (!currentSubMode? || link.dataset.navSubMode == currentSubMode)

      if isCurrent
        link.classList.add activeClass
      else
        link.classList.remove activeClass
