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

class @CheckboxValidation
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
