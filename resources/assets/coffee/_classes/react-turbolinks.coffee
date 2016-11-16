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
class @ReactTurbolinks
  constructor: (@components = {}) ->
    $(document).on 'turbolinks:load', @boot
    $(document).on 'turbolinks:before-cache', @destroy


  boot: =>
      for own _name, component of @components
        continue if component.loaded

        continue if component.target.length == 0

        component.loaded = true
        ReactDOM.render React.createElement(component.element, component.propsFunction()), component.target[0]


  destroy: =>
      for own _name, component of @components
        continue if !component.loaded

        component.loaded = false
        ReactDOM.unmountComponentAtNode component.target[0]


  register: (name, element, propsFunction = ->) =>
    return if @components[name]

    @components[name] =
      loaded: false
      target: document.getElementsByClassName("js-react--#{name}")
      element: element
      propsFunction: propsFunction

    @boot()
