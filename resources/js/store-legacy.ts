// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { getInt } from 'utils/math';

$(document).on('turbolinks:load', function() {
  const quantity = getInt($('.js-store-item-quantity').val()) ?? 0;

  if (quantity > 0) return;

  return $('.js-store-add-to-cart').hide();
});

