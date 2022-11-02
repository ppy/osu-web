# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute'
import core from 'osu-core-singleton'
import { showLoadingOverlay } from 'utils/loading-overlay'

export class StoreXsolla
  @promiseInit: (orderNumber) ->
    Promise.all([
      StoreXsolla.fetchToken(orderNumber), StoreXsolla.fetchScript()
    ]).then (values) ->
      StoreXsolla.onXsollaReady(orderNumber)
      XPayStationWidget.init(values[0])


  @fetchScript: ->
    core.turbolinksReload.load('https://static.xsolla.com/embed/paystation/1.0.7/widget.min.js') ? Promise.resolve()


  @fetchToken: (orderNumber) ->
    new Promise (resolve, reject) ->
      $.post route('payments.xsolla.token'), { orderNumber }
      .done (data) ->
        resolve(data)
      .fail (xhr) ->
        reject(xhr: xhr)


  @onXsollaReady: (orderNumber) ->
    done = false

    XPayStationWidget.on XPayStationWidget.eventTypes.STATUS_DONE, ->
      done = true

    XPayStationWidget.on XPayStationWidget.eventTypes.CLOSE, ->
      if done
        showLoadingOverlay()
        showLoadingOverlay.flush()
        window.location = route('payments.xsolla.completed', 'foreignInvoice': orderNumber)
