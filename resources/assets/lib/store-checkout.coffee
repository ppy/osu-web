# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

# TODO: migrate to store.ts.

import { StorePaypal } from 'store-paypal'
import { StoreXsolla } from 'store-xsolla'
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay'

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
      showLoadingOverlay()
      showLoadingOverlay.flush()

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
          hideLoadingOverlay()
          resolve()


  @handleError: (error) ->
    hideLoadingOverlay()
    # errors from they jquery deferred will propagate here.
    if error.getResponseHeader # check if 4xx ujs_redirect
      type = error.getResponseHeader('Content-Type')
      return if _.startsWith(type, 'application/javascript')

    # TODO: less unknown error, disable button
    # TODO: handle error.message
    osu.ajaxError(error?.xhr)
