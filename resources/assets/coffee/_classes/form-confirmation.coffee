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

class @FormConfirmation
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
