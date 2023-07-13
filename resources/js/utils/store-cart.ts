// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export function toggleCart(flag: boolean) {
  $('.js-store-add-to-cart').prop('disabled', !flag);
  $('#product-form').data('disabled', !flag);
}
