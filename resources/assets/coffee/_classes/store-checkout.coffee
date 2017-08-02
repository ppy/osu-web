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
    # load script
    deferredScript = $.Deferred()
    script = document.createElement('script')
    script.type = "text/javascript"
    script.async = true
    script.src = "https://static.xsolla.com/embed/paystation/1.0.7/widget.min.js"
    script.addEventListener 'load', ->
      deferredScript.resolve()
    , false
    document.head.appendChild(script)

    deferredToken = $.Deferred()
    # get token
    @getXsollaToken()
    .done (data) ->
      deferredToken.resolve(data)
    .fail (xhr, error) ->
      console.error xhr
      deferredToken.reject(xhr)

    $.when(deferredScript, deferredToken)
    .done (_, token) =>
      options = @optionsWithToken(token)
      XPayStationWidget.init(options)
      document.querySelector('#js-xsolla-pay').disabled = false
    .fail (error) ->
      console.error error

  @optionsWithToken: (token) ->
    options =
      access_token: token,
      sandbox: true

  @getXsollaToken: ->
    $.get laroute.route('payments.xsolla.token')

