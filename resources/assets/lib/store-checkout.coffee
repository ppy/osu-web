###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

import { StoreCentili } from 'store-centili'
import { StorePaypal } from 'store-paypal'
import { StoreXsolla } from 'store-xsolla'

export class StoreCheckout
  @CHECKOUT_SELECTOR: '.js-store-checkout-button'

  @initialize: =>
    traps = @allTraps()
    # load scripts
    init = {}
    document.querySelectorAll(@CHECKOUT_SELECTOR).forEach (element) ->
      provider = element.dataset.provider
      switch provider
        when 'paypal' then init['paypal'] = Promise.resolve()
        when 'xsolla' then init['xsolla'] = StoreXsolla.promiseInit()
        when 'centili' then  init['centili'] = StoreCentili.promiseInit()

    $(document.querySelectorAll(@CHECKOUT_SELECTOR)).on 'click.checkout', (event) ->
      promiseAll = (provider) ->
                     Promise.all([init[provider] || Promise.reject(), traps[provider]])

      provider = event.target.dataset.provider
      promise = switch provider
                when 'paypal'
                  promiseAll(provider).then (values) ->
                    StorePaypal.fetchApprovalLink(event.target.dataset.orderId).then (link) ->
                      window.location = link
                when 'xsolla'
                  promiseAll(provider).then (values) ->
                    StoreCheckout.onXsollaComplete(event.target.dataset.orderNumber)
                    # FIXME: flickering when transitioning to widget
                    XPayStationWidget.open()
                    LoadingOverlay.hide()
                when 'centili'
                  promiseAll(provider).then (values) ->
                    LoadingOverlay.hide()
                    # fake a click for Centili
                    $('#c-mobile-payment-widget').click()
                else
                  Promise.resolve()

      promise.catch (error) ->
        LoadingOverlay.hide()
        # TODO: less unknown error, disable button
        # TODO: handle error.message
        if error.xhr
          osu.ajaxError(error.xhr)
        else
          osu.ajaxError()

  @allTraps: ->
    traps = {}

    buttons = document.querySelectorAll(@CHECKOUT_SELECTOR)
    for button in buttons
      provider = button.dataset.provider
      traps[provider] = DeferrablePromise() if provider?

    $(buttons).on 'click.trap', (event) ->
      LoadingOverlay.showImmediate()
      traps[event.target.dataset.provider].resolve()

    traps

  @onXsollaComplete: (orderNumber) ->
    done = false

    XPayStationWidget.on XPayStationWidget.eventTypes.STATUS_DONE, (event, info) ->
      done = true

    XPayStationWidget.on XPayStationWidget.eventTypes.CLOSE, ->
      if done
        window.location = laroute.route('payments.xsolla.completed', 'foreignInvoice': orderNumber)
