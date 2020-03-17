# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

export class StorePaypal
  @fetchApprovalLink: (orderId) ->
    new Promise (resolve, reject) ->
      $.post laroute.route('payments.paypal.create'), order_id: orderId
      .done resolve
      .fail (xhr) ->
        reject(xhr: xhr)
