// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

// TODO: migrate to store.ts.

import { route } from 'laroute';
import { fetchApprovalLink } from 'store-paypal';
import { initXsolla } from 'store-xsolla';
import { isJqXHR, onError } from 'utils/ajax';
import { trans } from 'utils/lang';
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay';
import { popup } from 'utils/popup';

const checkoutSelector = '.js-store-checkout-button';

interface PaymentParams {
  orderId?: string;
  provider?: string;
}

export default class StoreCheckout {
  constructor() {
    document.addEventListener('turbo:load', () => {
      const init: Partial<Record<string, Promise<void>>> = {};
      for (const element of document.querySelectorAll<HTMLElement>(checkoutSelector)) {
        const { provider, orderNumber } = element.dataset;
        switch (provider) {
          case 'free': init.free = Promise.resolve(); break;
          case 'paypal': init.paypal = Promise.resolve(); break;
          case 'xsolla': init.xsolla = initXsolla(orderNumber); break;
        }
      }

      $(checkoutSelector).on('click.checkout', (event) => {
        const { orderId, provider } = event.target.dataset;
        // sanity
        if (provider == null) {
          return;
        }
        showLoadingOverlay();
        showLoadingOverlay.flush();

        init[provider]?.then(() => {
          const hide_from_activity = document.querySelector<HTMLInputElement>('.js-hide-from-activity')?.checked;
          $.post(route('store.checkout.store'), { hide_from_activity, provider, orderId });
        }).then(() => this.startPayment(event.target.dataset)).catch(this.handleError);
      });
    });
  }

  startPayment(params: PaymentParams) {
    const { orderId, provider } = params;
    switch (provider) {
      case 'paypal':
        return fetchApprovalLink(orderId).then((link) => window.location.href = link);

      case 'xsolla':
        return new Promise((resolve) => {
          // FIXME: flickering when transitioning to widget
          XPayStationWidget.open();
          hideLoadingOverlay();
          resolve(undefined);
        });
    }
  }


  private readonly handleError = (error: unknown) => {
    hideLoadingOverlay();
    if (isJqXHR(error)) {
      // check if 4xx ujs_redirect
      if (error.getResponseHeader('content-type') === 'application/javascript') {
        return;
      }

      // TODO: less unknown error, disable button
      // TODO: handle error.message
      onError(error);
    }

    popup(trans('errors.unknown'), 'danger');
  };
}
