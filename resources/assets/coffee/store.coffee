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

# address form show/hide.
$(document).on 'click', '#new-address-switch a', (e) ->
  e.preventDefault()
  $target = $(e.target)
  $form = $('#new-address-form')

  if $target.is(':visible')
    $target.siblings('button').show()
    $target.hide()
    $form.find('input').first().focus()
  else
    $target.siblings('button').hide()
    $target.show()
  $form.slideToggle()

#checkout checks
checkCheckoutConfirmations = ->
  $checkboxes = $('.js-checkout-confirmation-step')
  $checkboxesChecked = $checkboxes.filter(':checked')

$(document).on 'turbolinks:load', checkCheckoutConfirmations
$(document).on 'change', '.js-checkout-confirmation-step', checkCheckoutConfirmations

$(document).on 'turbolinks:load', ->
  quantity = parseInt $('.js-store-item-quantity').val(), 10

  return if quantity > 0

  $('.js-store-add-to-cart').hide()

$(document).on 'turbolinks:load', ->
  # delegating doesn't work because of timing.
  $('#product-form').submit (e) ->
    !$(e.target).data('disabled')
