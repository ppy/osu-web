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

# import { StoreCentili } from 'store-centili'
import { StoreXsolla } from 'store-xsolla'

export class StoreCheckout
  CHECKOUT_SELECTOR: '.js-store-checkout-button'

  @initialize: =>
    # Centili script relies on document write, so can't side-load :(
    # StoreCentili.fetchScript()
    button = document.querySelector('.js-store-checkout-button--xsolla')

    trap = @xsollaTrap()
    # load scripts
    init = @xsollaInit()

    checkout = DeferrablePromise()
    $(StoreCheckout::CHECKOUT_SELECTOR).on 'click.checkout', ->
        $.post laroute.route('store.checkout.store'), {}
        .done (data) ->
          checkout.resolve()
        .fail (xhr) ->
          checkout.reject(xhr: xhr)

    $(button).on 'click.xsolla', ->
      Promise.all([init, trap, checkout]).then (values) ->
        window.requestAnimationFrame ->
          # FIXME: flickering when transitioning to widget
          XPayStationWidget.open()
          LoadingOverlay.hide()
      .catch (error) ->
        LoadingOverlay.hide()
        # TODO: less unknown error, disable button
        # TODO: handle error.message
        if error.xhr
          osu.ajaxError(error.xhr)
        else
          osu.ajaxError()

  @xsollaTrap: ->
    trap = DeferrablePromise()
    $('.js-store-checkout-button--xsolla').on 'click.trap', ->
      # FIXME: don't display overlay if other promises get rejected.
      # FIXME: this is a good use case for rxjs....
      $('.js-store-checkout-button--xsolla').off 'click.trap'
      LoadingOverlay.showImmediate()

      trap.resolve()

    trap

  @xsollaInit: ->
    Promise.all([
      StoreXsolla.fetchToken(), StoreXsolla.fetchScript()
    ]).then (values) ->
      token = values[0]
      options = StoreXsolla.optionsWithToken(token)
      XPayStationWidget.init(options)
