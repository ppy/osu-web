# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class window.FormConfirmation
  constructor: (@formError) ->
    $(document).on 'input', '.js-form-confirmation', @onInput


  boot: (el) =>
    return if el.formConfirmation?

    fields = {}

    if _.endsWith(el.name, '_confirmation') || _.endsWith(el.name, '_confirmation]')
      mainName = el.name.replace /_confirmation(]?)$/, '$1'

      fields.confirmation = el
      fields.main = $(el).closest('form').find("[name='#{mainName}']")[0]
    else
      confirmationName = el.name.replace /(]?)$/, '_confirmation$1'

      fields.main = el
      fields.confirmation = $(el).closest('form').find("[name='#{confirmationName}']")[0]

    fields.main.formConfirmation = fields
    fields.confirmation.formConfirmation = fields


  onInput: (e) =>
    el = e.currentTarget

    @boot el

    fields = el.formConfirmation
    inputMain = fields.main.value
    inputConfirmation = fields.confirmation.value

    if inputMain.length == 0 || inputConfirmation.length == 0
      return @formError.setOneError fields.confirmation, []

    if inputMain == inputConfirmation
      return @formError.setOneError fields.confirmation, []

    @formError.setOneError fields.confirmation, [osu.trans 'model_validation.wrong_confirmation']
