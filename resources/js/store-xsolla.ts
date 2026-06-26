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
      init: (config: XsollaTokenResponse) => void;
      on: (event: string, callback: () => void) => void;
      open(): void;
    };
  }
}

interface XsollaTokenResponse {
  access_token: string;
  sandbox: boolean;
}

const xsollaWidgetUrl = 'https://cdn.xsolla.net/payments-bucket-prod/embed/1.5.4/widget.min.js';

function onXsollaReady(orderNumber: string) {
  let done = false;
  window.XPayStationWidget.on(window.XPayStationWidget.eventTypes.STATUS_DONE, () => done = true);
  window.XPayStationWidget.on(window.XPayStationWidget.eventTypes.CLOSE, () => {
    if (done) {
      showLoadingOverlay();
      showLoadingOverlay.flush();
      window.location.href = route('payments.xsolla.completed', { foreignInvoice: orderNumber });
    }
  });
}

export async function initXsolla(orderNumber: string) {
  const [tokenResponse] = await Promise.all([
    $.post(route('payments.xsolla.token'), { orderNumber }) as JQuery.jqXHR<XsollaTokenResponse>,
    core.turbolinksReload.load(xsollaWidgetUrl),
  ]);
  onXsollaReady(orderNumber);
  window.XPayStationWidget.init(tokenResponse);
}
