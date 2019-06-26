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
    $(document).on 'turbolinks:load', =>
      # Delayed to wait until cacheSnapshot finishes.
      @persistedTargets = @targets
      @targets = []
      Timeout.set 1, @destroyPersisted

      @documentReady = true
      @boot()
    $(document).on 'turbolinks:before-cache', =>
      @documentReady = false
      @destroy()


  boot: =>
    return unless @documentReady

    for own _name, component of @components
      for target in component.targets
        continue if target.dataset.reactTurbolinksLoaded == '1'
        target.dataset.reactTurbolinksLoaded = '1'
        @targets.push target
        ReactDOM.render React.createElement(component.element, component.propsFunction(target)), target


  destroy: =>
    for own _name, component of @components
      for target in component.targets
        continue if target.dataset.reactTurbolinksLoaded != '1'
        target.dataset.reactTurbolinksLoaded = null
        ReactDOM.unmountComponentAtNode target if !component.persistent


  destroyPersisted: =>
    ReactDOM.unmountComponentAtNode(target) while target = @persistedTargets.pop()


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
