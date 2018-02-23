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

class @Nav
  constructor: ->
    $(document).on 'mouseenter', '.js-nav-popup', @delayedShowPopup
    $(document).on 'mouseleave', '.js-nav-popup', @delayedHidePopup
    $(document).on 'click', @hidePopup

    $(document).on 'click', '.js-nav-toggle', @toggleMenu
    $(document).on 'click', '.js-nav-switch', @switchMode
    $(window).on 'throttled-scroll throttled-resize', @repositionPopup
    $(document).on 'transitionend', '.js-nav-popup--container', @reset
    $(document).on 'turbolinks:load', @syncAll
    $(document).on 'menu:showing', '.js-nav-submenu', @resizePopup

    @_data = document.getElementsByClassName('js-nav-data')
    @popup = document.getElementsByClassName('js-nav-popup--popup')
    @popupContainer = document.getElementsByClassName('js-nav-popup--container')
    @menus = document.getElementsByClassName('js-nav-switch--menu')
    @switches = document.getElementsByClassName('js-nav-switch')
    @floatBeacon = document.getElementsByClassName('js-nav-popup--beacon')


  autoFocus: (e, popup) =>
    return if !@data().visible

    if e?
      popup = e.currentTarget

    return if popup.dataset.navMode != @currentMode()

    popup.getElementsByClassName('js-nav-auto-focus')[0]?.focus?()


  available: (force = false) =>
    (force || !document.body.classList.contains('modal-open')) && @popup[0]?


  clearTimeouts: =>
    Timeout.clear @hideTimeout
    Timeout.clear @showTimeout


  currentMode: =>
    @data().currentMode ?= 'default'


  currentSubMode: =>
    @data().currentSubMode


  data: =>
    @_data[0].dataset


  delayedHidePopup: =>
    return if @currentMode() == 'user' && !currentUser.id?
    return if @currentMode() == 'search'

    @clearTimeouts()
    @hideTimeout = Timeout.set 50, @hidePopup


  delayedShowPopup: =>
    @clearTimeouts()
    @showTimeout = Timeout.set 50, @showPopup


  floatPopup: (float) =>
    if float
      @popupContainer[0].style.position = 'fixed'
      @popupContainer[0].style.top = '0'
      @popupContainer[0].style.width = '100%'
    else
      @popupContainer[0].style.position = ''


  hidePopup: (e) =>
    return if !@available(true)
    return if !@data().visible

    if e?
      $target = $(e.target)

      hide = $target.closest('.js-nav--hide').length != 0 && osu.isClickable($target[0])
      hide ||= $target.closest('.js-nav-popup').length == 0

      return if !hide

    @clearTimeouts()
    @hideTimeout = Timeout.set 10, =>
      @showAllMenu false
      $.publish 'nav:popup:hidden'


  repositionPopup: =>
    return if !@available()
    return if !@data().visible

    if @currentMode() == 'user' && !currentUser.id?
      beaconPosition = @floatBeacon[0].getBoundingClientRect()

      float = beaconPosition.bottom < 0
    else
      float = false

    @floatPopup float


  reset: =>
    return if @data().visible

    @setMode()
    @floatPopup false


  resizePopup: (e) =>
    menu = e.currentTarget
    # FIXME: Temporary hack until redesign.
    # 210 is default menu size.
    # 110 is popup footer + top menu bar + paddings.
    $last = $(menu).children('a:last')
    bottom = $last.position().top + $last.height()
    height = Math.max(210, bottom + 110)
    $('.js-nav-popup-auto-size').css('height', "#{height}px")


  setMode: (modeHash = {}) =>
    return if !@available()

    newMode = modeHash.navMode ? modeHash.mode ? 'default'
    newSubMode = modeHash.navSubMode ? modeHash.subMode ? ''

    return false if newMode == @data().currentMode && newSubMode == @data().currentSubMode

    @data().currentMode = newMode
    @data().currentSubMode = newSubMode
    @syncMode()
    $.publish 'nav:mode:set', mode: newMode
    true


  showAllMenu: (enable) =>
    @data().visible = if enable then '1' else ''

    @syncMenu()


  showPopup: =>
    return if !@available()

    @clearTimeouts()
    @showTimeout = Timeout.set 10, =>
      @showAllMenu true
      @repositionPopup()


  switchMode: (e) =>
    if e?
      e.preventDefault()

      modeHash = e.currentTarget.dataset
      modeHash = null if @currentMode() == modeHash.navMode && modeHash.navModeSwitch != '0'

    @setMode modeHash


  syncAll: =>
    @syncMenu()
    @syncMode()


  syncMenu: =>
    for menu in @menus
      if @data().visible
        menu.classList.add 'js-nav-switch--visible'
      else
        menu.classList.remove 'js-nav-switch--visible'


  syncMode: =>
    animateClass = 'js-nav-switch--animated'
    activeClass = 'js-nav-switch--active'

    for menu in @menus
      if @data().visible
        menu.classList.add animateClass
      else
        menu.classList.remove animateClass

      if menu.dataset.navMode == @currentMode()
        menu.classList.add activeClass

        for submenu in menu.getElementsByClassName('js-nav-popup--submenu')
          if !@currentSubMode() || submenu.dataset.navSubMode == @currentSubMode()
            submenu.classList.remove 'hidden'
          else
            submenu.classList.add 'hidden'

        if menu.classList.contains 'js-nav-switch--animated'
          $(menu)
            .off 'transitionend', @autoFocus
            .one 'transitionend', @autoFocus
        else
          Timeout.set 0, => @autoFocus null, menu

      else
        menu.classList.remove activeClass

    for link in @switches
      isCurrent =
        link.dataset.navMode == @currentMode() &&
        (!@currentSubMode() || link.dataset.navSubMode == @currentSubMode())

      if isCurrent
        link.classList.add activeClass
      else
        link.classList.remove activeClass


  toggleMenu: (e) =>
    e.preventDefault()
    e.stopPropagation()

    if @setMode e.currentTarget.dataset
      @showPopup() unless @data().visible
    else
      @hidePopup()
