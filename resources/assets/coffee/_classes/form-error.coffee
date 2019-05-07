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

class @FormError
  constructor: ->
    $(document).on 'ajax:error', '.js-form-error', @showError
    $(document).on 'ajax:success', '.js-form-error', @clearError


  clearError: (e) =>
    @setError e.target


  flattenData: (data, prefixes = []) =>
    flat = {}

    for own key, value of data
      if Array.isArray(value)
        flatKey = ''

        for prefix, i in prefixes
          flatKey +=
            if i == 0
              prefix
            else
              "[#{prefix}]"

        flatKey +=
          if flatKey == ''
            key
          else
            "[#{key}]"

        flat[flatKey] = value
      else if value instanceof Object
        _.merge flat, @flattenData(value, prefixes.concat(key))

    flat


  showError: (e, xhr) =>
    data = xhr.responseJSON?.form_error

    return osu.ajaxError(xhr) if !data?

    @setError e.target, @flattenData(data)


  setError: (form, data = {}) =>
    $(form)
      .find '[name]'
      .each (_i, el) =>
        @setOneError el, data[el.name]


  setOneError: (el, errors = []) =>
    state = if errors.length > 0 then 'error' else ''

    $(el)
      .closest 'label, .js-form-error--field'
      .attr 'data-form-error-state', state
      .find '.js-form-error--error'
      .text errors.join(' ')
