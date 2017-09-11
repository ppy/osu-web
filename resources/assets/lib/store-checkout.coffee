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
import { StoreXsolla } from 'store-xsolla'

export class StoreCheckout
  CHECKOUT_SELECTOR: '.js-store-checkout-button'

  @initialize: =>
    traps = @allTraps()
    # load scripts
    init = StoreXsolla.promiseInit()
    centili = StoreCentili.promiseInit()
    checkout = DeferrablePromise()

    $(StoreCheckout::CHECKOUT_SELECTOR).on 'click.checkout', ->
      $.post laroute.route('store.checkout.store'), {}
      .done (data) ->
        checkout.resolve()
      .fail (xhr) ->
        checkout.reject(xhr: xhr)

    $(document.querySelectorAll('.js-store-checkout-button')).on 'click.xsolla', (event) ->
      dataset = event.target.dataset

      if dataset.provider == 'xsolla'
        promise = Promise.all([init, traps['xsolla'], checkout]).then (values) ->
          window.requestAnimationFrame ->
            # FIXME: flickering when transitioning to widget
            XPayStationWidget.open()
            LoadingOverlay.hide()
      else if dataset.provider == 'centili'
        promise = Promise.all([centili, traps['centili'], checkout]).then (values) ->
          LoadingOverlay.hide()
          # fake a click for Centili
          $('#c-mobile-payment-widget').click()
      else
        promise = Promise.resolve()

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
    buttons = document.querySelectorAll('.js-store-checkout-button')
    for button in buttons
      traps[button.dataset.provider] = DeferrablePromise()

    $(buttons).on 'click.trap', (event) ->
      LoadingOverlay.showImmediate()
      traps[event.target.dataset.provider].resolve()

    traps
