// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { getInt } from 'utils/math';

// checkout checks
function checkCheckoutConfirmations() {
  const $checkboxes = $('.js-checkout-confirmation-step');
  return $checkboxes.filter(':checked');
}

$(document).on('turbolinks:load', checkCheckoutConfirmations);
$(document).on('change', '.js-checkout-confirmation-step', checkCheckoutConfirmations);

$(document).on('turbolinks:load', function() {
  const quantity = getInt($('.js-store-item-quantity').val()) ?? 0;

  if (quantity > 0) return;

  return $('.js-store-add-to-cart').hide();
});

$(document).on('turbolinks:load', () => { // delegating doesn't work because of timing.
  $('#product-form').submit((e) => !($(e.target).data('disabled') as boolean));
});
