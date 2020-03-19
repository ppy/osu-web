# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

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
