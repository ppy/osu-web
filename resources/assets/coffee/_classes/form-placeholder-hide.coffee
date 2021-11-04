# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class window.FormPlaceholderHide
  constructor: ->
    $(document).on 'focus', '.js-form-placeholder-hide', @onFocus
    $(document).on 'blur', '.js-form-placeholder-hide', @onBlur


  onBlur: (e) ->
    return unless e.target._origPlaceholder
    e.target.setAttribute 'placeholder', e.target._origPlaceholder
    e.target._origPlaceholder = null


  onFocus: (e) ->
    e.target._origPlaceholder = e.target.getAttribute 'placeholder'
    e.target.setAttribute 'placeholder', ''
