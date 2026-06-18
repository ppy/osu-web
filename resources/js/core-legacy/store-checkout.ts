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

interface PaymentParams {
  orderId?: string;
  provider?: string;
}

type TriggeredEvent = JQuery.TriggeredEvent<Document, unknown, HTMLElement, HTMLElement>;

export default class StoreCheckout {
  constructor() {
    document.addEventListener('turbo:load', () => {
      $(document).on('click.checkout', '.js-store-checkout-button', (event: TriggeredEvent) => void this.handleCheckoutClick(event));
    });
  }

  private async handleCheckoutClick(event: TriggeredEvent) {
    const { orderId, orderNumber, provider } = event.target.dataset;
    // sanity
    if (provider == null) return;
    showLoadingOverlay();
    showLoadingOverlay.flush();

    if (provider === 'xsolla' && orderNumber != null) {
      await initXsolla(orderNumber);
    }

    const hideFromActivity = document.querySelector<HTMLInputElement>('.js-hide-from-activity')?.checked;
    await $.post(route('store.checkout.store'), { hideFromActivity, orderId, provider });
    try {
      this.startPayment(event.target.dataset);
    } catch (error) {
      this.handleError(error);
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

  private startPayment(params: PaymentParams) {
    const { orderId, provider } = params;
    switch (provider) {
      case 'paypal':
        fetchApprovalLink(orderId).then((link) => window.location.href = link);
        break;

      case 'xsolla':
        // FIXME: flickering when transitioning to widget
        XPayStationWidget.open();
        hideLoadingOverlay();
        break;
    }
  }
}
