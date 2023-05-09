# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { onError } from 'utils/ajax'
import { flattenFormErrorJson } from 'utils/json'

export default class FormError
  constructor: ->
    $(document).on 'ajax:error', '.js-form-error', @showError
    $(document).on 'ajax:success', '.js-form-error', @clearError


  clearError: (e) =>
    @setError e.target


  showError: (e, xhr) =>
    data = xhr.responseJSON?.form_error

    return onError(xhr) if !data?

    @setError e.target, flattenFormErrorJson(data)


  setError: (form, data) =>
    $(form)
      .find '[name]'
      .each (_i, el) =>
        @setOneError el, data?.get(el.name)


  setOneError: (el, errors) =>
    errors ?= []
    state = if errors.length > 0 then 'error' else ''

    $(el)
      .closest 'label, .js-form-error--field'
      .attr 'data-form-error-state', state
      .find '.js-form-error--error'
      .text errors.join(' ')
