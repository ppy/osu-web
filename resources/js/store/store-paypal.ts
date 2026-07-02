// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';

export function fetchApprovalLink(orderId: string) {
  return $.post(route('payments.paypal.create'), { order_id: orderId }) as JQuery.jqXHR<string>;
}
