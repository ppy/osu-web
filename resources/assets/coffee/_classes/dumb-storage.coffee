# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

# Kind of implements localStorage
class window.DumbStorage
  constructor: ->
    @_data = {}


  clear: =>
    @_data = {}


  getItem: (key) =>
    if @_data.hasOwnProperty(key)
      @_data[key]
    else
      null


  removeItem: (key) =>
    delete @_data[key]


  setItem: (key, value) =>
    @_data[key] = String(value)
