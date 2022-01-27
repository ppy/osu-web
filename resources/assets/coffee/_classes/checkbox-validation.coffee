# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class window.CheckboxValidation
  constructor: ->
    $(document).on 'change', '.js-checkbox-validation', @validate


  validate: (e) =>
    e.currentTarget._checkboxValidationCache ?= JSON.parse(e.currentTarget.dataset.checkboxValidation)

    name = e.target.name
    data = e.currentTarget._checkboxValidationCache[name]

    return if !data?

    checkboxes = e.currentTarget.querySelectorAll("[name='#{name}']")
    submit = e.currentTarget.getElementsByClassName('js-checkbox-validation--submit')[0]

    current = 0
    current += 1 for checkbox in checkboxes when checkbox.checked

    submit.disabled = current < data.min || current > data.max
