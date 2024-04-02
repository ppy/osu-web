// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export function toggleCart(flag: boolean) {
  const body = window.newBody;
  if (body == null) return;

  const button = body.querySelector<HTMLButtonElement>('.js-store-add-to-cart');
  if (button != null) {
    button.disabled = !flag;
  }

  const form = body.querySelector<HTMLFormElement>('#product-form');
  if (form != null) {
    $(form).data('disabled', !flag);
  }
}
