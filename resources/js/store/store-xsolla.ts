// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import core from 'osu-core-singleton';
import { showLoadingOverlay } from 'utils/loading-overlay';

declare global {
  interface Window {
    XPayStationWidget: {
      eventTypes: {
        CLOSE: string;
        STATUS_DONE: string;
      };
      init(config: XsollaOptions): void;
      on(event: string, callback: () => void): void;
      open(): void;
    };
  }
}

interface XsollaOptions {
  access_token: string;
  sandbox: boolean;
}

export interface XsollaParams extends XsollaOptions {
  order_number: string;
}

const xsollaWidgetUrl = 'https://cdn.xsolla.net/payments-bucket-prod/embed/1.5.4/widget.min.js';

export function openXsollaWidget(response: XsollaParams) {
  let done = false;
  // FIXME: flickering when transitioning to widget
  window.XPayStationWidget.init({
    access_token: response.access_token,
    sandbox: response.sandbox,
  });

  window.XPayStationWidget.on(window.XPayStationWidget.eventTypes.STATUS_DONE, () => done = true);
  window.XPayStationWidget.on(window.XPayStationWidget.eventTypes.CLOSE, () => {
    if (done) {
      showLoadingOverlay();
      showLoadingOverlay.flush();
      window.location.href = route('payments.xsolla.completed', { foreignInvoice: response.order_number });
    }
  });

  window.XPayStationWidget.open();
}

export function loadXsollaWidget() {
  return core.turbolinksReload.load(xsollaWidgetUrl);
}
