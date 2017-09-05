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

class @StoreCheckout

  @initialize: ->
    return unless document.querySelector('#js-xsolla-pay')
    button = document.querySelector('#js-xsolla-pay')

    # load scripts
    init = Promise.all([@loadXsollaToken(), @loadXsollaScript()])
    .then (values) =>
      console.debug('resolved all')
      token = values[0]
      options = @optionsWithToken(token)
      XPayStationWidget.init(options)

    .catch (error) ->
      console.error error

    click = DeferrablePromise()

    $(button).on 'click', ->
      button.classList.add('store-payment-button--waiting')
      click.resolve()

    $(button).on 'click', ->
      Promise.all([init, click]).then (values) ->
        console.log(values)
        XPayStationWidget.open()

  @loadXsollaScript: ->
    new Promise (resolve, reject) ->
      script = document.createElement('script')
      script.type = "text/javascript"
      script.async = true
      script.src = "https://static.xsolla.com/embed/paystation/1.0.7/widget.min.js"
      script.addEventListener 'load', ->
        console.debug('script loaded')
        # TODO: remove after testing
        Timeout.set 5000, ->
          resolve()
      , false

      document.head.appendChild(script)

  @loadXsollaToken: ->
    new Promise (resolve, reject) ->
      $.get laroute.route('payments.xsolla.token')
      .done (data) ->
        console.debug('token loaded')
        resolve(data)
      .fail (xhr, error) ->
        console.error xhr
        reject(xhr)

  @optionsWithToken: (token) ->
    options =
      access_token: token,
      sandbox: true
