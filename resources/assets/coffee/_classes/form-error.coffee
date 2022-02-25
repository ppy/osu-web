# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class window.FormError
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
