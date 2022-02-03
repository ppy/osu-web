# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class window.Polyfills
  constructor: ->
    @localStorage()


  # Mainly for Safari Private Mode.
  localStorage: ->
    try
      window.localStorage.setItem '_test', '1'
      window.localStorage.removeItem '_test'
    catch
      localStorage = new DumbStorage
      window.localStorage = localStorage
      window.localStorage.__proto__ = localStorage
