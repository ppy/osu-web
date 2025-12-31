// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Cart, CartCreatePayload } from '@shopify/hydrogen-react/storefront-api-types';
import { route } from 'laroute';
import core from 'osu-core-singleton';
import { toShopifyVariantGid } from 'shopify-gid';
import { createClickCallback } from 'utils/html';
import { trans } from 'utils/lang';
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay';
import { popup } from 'utils/popup';
import storefrontClient from './shopify-client';

declare global {
  interface Window {
    Store?: Store;
  }
}

type ClickEvent = JQuery.ClickEvent<Document, unknown, HTMLElement, HTMLElement>;

export class Store {
  private constructor() {
    $(document).on('click', '.js-store-checkout', (event: ClickEvent) => void this.beginCheckout(event));
    $(document).on('click', '.js-store-resume-checkout', (event: ClickEvent) => this.resumeCheckout(event));

    $(document).on('turbo:load', () => {
      $('.js-store-checkout').prop('disabled', false);
    });

    $('.js-store-checkout').prop('disabled', false);
  }

  static init(sharedContext: Window) {
    sharedContext.Store = sharedContext.Store ?? new Store();
  }

  async beginCheckout(event: ClickEvent) {
    if (event.target == null) return;

    const dataset = event.target.dataset;
    const orderId = dataset.orderId;
    const shouldShopify = dataset.shopify === '1';
    if (orderId == null) {
      throw new Error('orderId is missing');
    }

    if (shouldShopify) {
      try {
        await this.beginShopifyCheckout(orderId);
      } catch (error) {
        hideLoadingOverlay();
        core.userVerification.showOnError(error, createClickCallback(event.target));
      }

      return;
    }

    Turbo.visit(route('store.checkout.show', { checkout: orderId }));
  }

  async beginShopifyCheckout(orderId: string) {
    showLoadingOverlay();
    showLoadingOverlay.flush();

    const operation = `
      mutation CreateCart($input: CartInput) {
        cartCreate(input: $input) {
          cart {
            id
            checkoutUrl
            lines(first: 10) {
              edges {
                node {
                  id
                  merchandise {
                    ... on ProductVariant {
                      id
                      title
                    }
                  }
                }
              }
            }
            cost {
              totalAmount {
                amount
                currencyCode
              }
            }
          }
        }
      }
    `;

    // create shopify checkout.
    // error returned will be a JSON string in error.message
    const response = await storefrontClient().request(operation, { variables: { input: this.shopifyCartInput(orderId) } });
    const data = response.data as { cartCreate: CartCreatePayload };

    if (response.errors != null || data.cartCreate.cart == null) {
      hideLoadingOverlay();
      popup(trans('errors.checkout.generic'), 'danger');
      return;
    }

    const params = {
      orderId,
      provider: 'shopify',
      shopifyCheckoutId: data.cartCreate.cart.id,
    };

    await $.post(route('store.checkout.store'), params);
    this.validateAndRedirect(data.cartCreate.cart.checkoutUrl);
  }

  resumeCheckout(event: ClickEvent) {
    if (event.target == null) return;

    const target = event.target;
    const { provider, providerReference, shopifyUrl, status } = target.dataset;

    // TODO: replace the links with just links...
    if (provider === 'shopify' && status !== 'cancelled') {
      if (shopifyUrl != null) {
        this.validateAndRedirect(shopifyUrl);
      } else if (providerReference != null) {
        this.resumeShopifyCheckout(providerReference);
      } else {
        // TODO: show error.
      }
    } else {
      Turbo.visit(route('store.invoice.show', { invoice: target.dataset.orderId }));
    }
  }

  async resumeShopifyCheckout(cartId: string) {
    showLoadingOverlay();
    showLoadingOverlay.flush();

    const operation = `
      query ($cartId: ID!) {
        cart(id: $cartId) {
          id
          checkoutUrl
          attributes {
            key
            value
          }
        }
      }
    `;

    const response = await storefrontClient().request(operation, { variables: { cartId } });
    const data = response.data as { cart?: Cart };

    if (response.errors != null || data.cart == null) {
      hideLoadingOverlay();
      popup(trans('errors.checkout.generic'), 'danger');
      return;
    }

    if (data.cart == null) {
      popup(trans('store.order.shopify_expired'), 'info');
      hideLoadingOverlay();
    } else {
      this.validateAndRedirect(data.cart.checkoutUrl);
    }
  }

  private validateAndRedirect(url: string | null | undefined) {
    if (!url) return;

    try {
      const parsed = new URL(url);
      const isSafe = parsed.hostname === window.location.hostname ||
        parsed.hostname.endsWith('.ppy.sh') ||
        parsed.hostname.endsWith('.myshopify.com');

      if (isSafe) {
        window.location.href = url;
      } else {
        console.error('Blocked unsafe redirect to:', url);
      }
    } catch (e) {
      if (url.startsWith('/') && !url.startsWith('//')) {
        window.location.href = url;
      }
    }
  }

  private collectShopifyCartLines() {
    return $('.js-store-order-item').map((_, element) => ({
      merchandiseId: toShopifyVariantGid(element.dataset.shopifyId),
      quantity: Number(element.dataset.quantity),
    })).get();
  }

  private shopifyCartInput(orderId: string) {
    return {
      attributes: [{ key: 'orderId', value: orderId }],
      lines: this.collectShopifyCartLines(),
    };
  }
}
