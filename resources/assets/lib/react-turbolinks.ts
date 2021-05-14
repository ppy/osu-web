# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import * as ReactDOM from 'react-dom'

isTurbolinksPermanent = (element) =>
  element.dataset.turbolinksPermanent? && element.id != ''


export class ReactTurbolinks
  constructor: (@components = {}) ->
    @documentReady = false
    @targets = new Set
    @newVisit = true
    @scrolled = false

    $(document).on 'turbolinks:before-cache', @onBeforeCache
    $(document).on 'turbolinks:before-visit', @onBeforeVisit
    $(document).on 'turbolinks:load', @onLoad


  allTargets: (callback) =>
    for own name, component of @components
      for target in component.targets
        callback({ name, component, target })


  boot: =>
    return unless @documentReady

    @allTargets ({ target, component }) =>
      return if @targets.has(target)

      @targets.add target
      ReactDOM.render React.createElement(component.element, component.propsFunction(target)), target


  destroy: =>
    @allTargets ({ target, component }) =>
      if !isTurbolinksPermanent(target) && @targets.has(target) && !component.persistent
        ReactDOM.unmountComponentAtNode target


  destroyPersisted: =>
    for target from @targets.values()
      continue if isTurbolinksPermanent(target) && document.body.contains(target)

      ReactDOM.unmountComponentAtNode(target)
      @targets.delete target


  onBeforeCache: =>
    Timeout.clear @scrollTimeout
    @documentReady = false
    @destroy()


  onBeforeVisit: =>
    @newVisit = true


  onLoad: =>
    @scrolled = false
    $(window).off 'scroll', @onWindowScroll
    $(window).on 'scroll', @onWindowScroll

    # Delayed to wait until cacheSnapshot finishes. The delay matches Turbolinks' defer.
    Timeout.set 1, =>
      @destroyPersisted()
      @documentReady = true
      @boot()
      @scrollTimeout = Timeout.set 100, @scrollOnNewVisit


  onWindowScroll: =>
    @scrolled = @scrolled || window.scrollX != 0 || window.scrollY != 0


  register: (name, element, propsFunction = ->) =>
    @registerPersistent name, element, false, propsFunction


  registerPersistent: (name, element, persistent = true, propsFunction = ->) =>
    return if @components[name]

    @components[name] =
      loaded: false
      persistent: persistent
      targets: document.getElementsByClassName("js-react--#{name}")
      element: element
      propsFunction: propsFunction

    @boot()


  scrollOnNewVisit: =>
    $(window).off 'scroll', @onWindowScroll
    newVisit = @newVisit
    @newVisit = false

    return if !newVisit || @scrolled

    targetId = decodeURIComponent document.location.hash.substr(1)

    return if targetId == ''

    document.getElementById(targetId)?.scrollIntoView()
