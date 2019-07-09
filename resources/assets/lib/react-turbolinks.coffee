###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

import * as React from 'react'
import * as ReactDOM from 'react-dom'

export class ReactTurbolinks
  constructor: (@components = {}) ->
    @documentReady = false
    @targets = []
    @newVisit = true
    @scrolled = false

    $(window).on 'scroll', =>
      @scrolled = @scrolled || window.scrollX != 0 || window.scrollY != 0

    $(document).on 'turbolinks:load', =>
      @scrolled = false
      # Delayed to wait until cacheSnapshot finishes. The delay matches Turbolinks' defer.
      Timeout.set 1, =>
        @deleteLoadedMarker()
        @destroyPersisted()
        @documentReady = true
        @boot()
        @scrollTimeout = Timeout.set 100, @scrollOnNewVisit

    $(document).on 'turbolinks:before-cache', =>
      Timeout.clear @scrollTimeout
      @documentReady = false
      @destroy()

    $(document).on 'turbolinks:before-visit', =>
      @newVisit = true


  allTargets: (callback) =>
    for own name, component of @components
      for target in component.targets
        callback({ name, component, target })


  boot: =>
    return unless @documentReady

    @allTargets ({ target, component }) =>
      return if target.dataset.reactTurbolinksLoaded == '1'

      target.dataset.reactTurbolinksLoaded = '1'
      @targets.push target
      ReactDOM.render React.createElement(component.element, component.propsFunction(target)), target


  deleteLoadedMarker: =>
    @allTargets ({ target }) =>
      delete target.dataset.reactTurbolinksLoaded if target.dataset.reactTurbolinksLoaded?


  destroy: =>
    @allTargets ({ target, component }) =>
      if target.dataset.reactTurbolinksLoaded == '1' && !component.persistent
        ReactDOM.unmountComponentAtNode target


  destroyPersisted: =>
    ReactDOM.unmountComponentAtNode(target) while target = @targets.pop()


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
    return if !@newVisit || @scrolled

    @newVisit = false

    targetId = document.location.hash.substr(1)

    return if targetId == ''

    document.getElementById(targetId)?.scrollIntoView()
