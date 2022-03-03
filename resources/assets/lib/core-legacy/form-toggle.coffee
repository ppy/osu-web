# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

export default class FormToggle
  constructor: ->
    addEventListener 'turbolinks:load', @sync
    $(document).on 'change', '.js-form-toggle--input', @onChange


  onChange: (e) =>
    @toggle e.currentTarget


  sync: =>
    inputs = document.getElementsByClassName('js-form-toggle--input')

    @toggle(input) for input in inputs


  toggle: (input) ->
    id = input.dataset.formToggleId
    show = input.checked

    $form = $(".js-form-toggle--form[data-form-toggle-id='#{id}']")

    direction = if show then 'Down' else 'Up'
    $form.stop()["slide#{direction}"]()
