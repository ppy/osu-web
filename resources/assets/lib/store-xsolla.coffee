###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import { route } from 'laroute'

export class StoreXsolla
  @promiseInit: (orderNumber) ->
    Promise.all([
      StoreXsolla.fetchToken(orderNumber), StoreXsolla.fetchScript()
    ]).then (values) ->
      token = values[0]
      options = StoreXsolla.optionsWithToken(token)
      StoreXsolla.onXsollaReady(orderNumber)
      XPayStationWidget.init(options)


  @fetchScript: ->
    new Promise (resolve, reject) ->
      loading = window.turbolinksReload.load 'https://static.xsolla.com/embed/paystation/1.0.7/widget.min.js', resolve
      resolve() unless loading


  @fetchToken: (orderNumber) ->
    new Promise (resolve, reject) ->
      $.post route('payments.xsolla.token'), { orderNumber }
      .done (data) ->
        # Make sure laroute hasn't trolled us.
        return reject(message: 'wrong token length') unless data.length == 32
        resolve(data)
      .fail (xhr) ->
        reject(xhr: xhr)


  @optionsWithToken: (token) ->
    access_token: token,
    sandbox: process.env.PAYMENT_SANDBOX # injected by webpack.DefinePlugin


  @onXsollaReady: (orderNumber) ->
    done = false

    XPayStationWidget.on XPayStationWidget.eventTypes.STATUS_DONE, ->
      done = true

    XPayStationWidget.on XPayStationWidget.eventTypes.CLOSE, ->
      if done
        LoadingOverlay.show()
        LoadingOverlay.show.flush()
        window.location = route('payments.xsolla.completed', 'foreignInvoice': orderNumber)
