# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class window.FormClear
  constructor: ->
    $(document).on 'ajax:success', '.js-form-clear', @clear


  clear: (e) ->
    e.currentTarget.reset()
