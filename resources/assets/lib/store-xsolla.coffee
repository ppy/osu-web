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
      $.post laroute.route('payments.xsolla.token'), { orderNumber }
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
        window.location = laroute.route('payments.xsolla.completed', 'foreignInvoice': orderNumber)
