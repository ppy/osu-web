###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
#
#    This file is part of osu!web. osu!web is distributed with the hope of
#    attracting more community contributions to the core ecosystem of osu!.
#
#    osu!web is free software: you can redistribute it and/or modify
#    it under the terms of the Affero GNU General Public License version 3
#    as published by the Free Software Foundation.
#
#    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
#    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
#    See the GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###

# TODO: migrate to store.ts.

import { StorePaypal } from 'store-paypal'
import { StoreXsolla } from 'store-xsolla'

export class StoreCheckout
  @CHECKOUT_SELECTOR: '.js-store-checkout-button'

  @initialize: =>
    # load scripts
    init = {}

    for element in document.querySelectorAll(@CHECKOUT_SELECTOR)
      provider = element.dataset.provider
      orderNumber = element.dataset.orderNumber
      switch provider
        when 'centili' then init['centili'] = Promise.resolve()
        when 'free' then init['free'] = Promise.resolve()
        when 'paypal' then init['paypal'] = Promise.resolve()
        when 'xsolla' then init['xsolla'] = StoreXsolla.promiseInit(orderNumber)

    $(@CHECKOUT_SELECTOR).on 'click.checkout', (event) =>
      { orderId, provider } = event.target.dataset
      # sanity
      return unless provider?
      LoadingOverlay.show()
      LoadingOverlay.show.flush()

      init[provider]?.then ->
        window.osu.promisify $.post(laroute.route('store.checkout.store'), { provider, orderId })
      .then =>
        @startPayment(event.target.dataset)
      .catch @handleError


  @startPayment: (params) ->
    { orderId, provider, url } = params
    switch provider
      when 'centili'
        new Promise (resolve) ->
          window.location.href = url

      when 'free'
        window.osu.promisify $.post(laroute.route('store.checkout.store', { orderId, provider }))

      when 'paypal'
        StorePaypal.fetchApprovalLink(orderId).then (link) ->
          window.location.href = link

      when 'xsolla'
        new Promise (resolve) ->
          # FIXME: flickering when transitioning to widget
          XPayStationWidget.open()
          LoadingOverlay.hide()
          resolve()


  @handleError: (error) ->
    LoadingOverlay.hide()
    # errors from they jquery deferred will propagate here.
    if error.getResponseHeader # check if 4xx ujs_redirect
      type = error.getResponseHeader('Content-Type')
      return if _.startsWith(type, 'application/javascript')

    # TODO: less unknown error, disable button
    # TODO: handle error.message
    osu.ajaxError(error?.xhr)
