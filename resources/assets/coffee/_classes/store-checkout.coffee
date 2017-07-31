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
    document.querySelector('#js-xsolla-pay').disabled = true
    xhr = @getXsollaToken()
    xhr.done (data) ->
      console.log(data)
      StoreCheckout.initializeXsollaCheckout(data)

  @initializeXsollaCheckout: (token) ->
    options =
      access_token: token,
      sandbox: true

    StoreCheckout.initButton(options)

  @initButton: (options) ->
    s = document.createElement('script')
    s.type = "text/javascript"
    s.async = true
    s.src = "https://static.xsolla.com/embed/paystation/1.0.7/widget.min.js"
    s.addEventListener 'load', ->
      console.debug 'xsolla widget loaded'
      console.log(options)
      XPayStationWidget.init(options)
      document.querySelector('#js-xsolla-pay').disabled = false
    , false
    head = document.getElementsByTagName('head')[0]
    head.appendChild(s)

  @getXsollaToken: ->
    $.get laroute.route('store.payments.xsolla-token')
