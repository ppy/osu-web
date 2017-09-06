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
    # can't side-load?
    # StoreCentili.fetchScript()
    return unless document.querySelector('#js-xsolla-pay')
    button = document.querySelector('#js-xsolla-pay')

    trap = DeferrablePromise()
    $(button).on 'click.trap', ->
      LoadingOverlay.showImmediate()
      $(button).off 'click.trap'
      trap.resolve()

    # load scripts
    init = Promise.all([StoreXsolla.fetchToken(), StoreXsolla.fetchScript()])
    .then (values) ->
      token = values[0]
      options = StoreXsolla.optionsWithToken(token)
      XPayStationWidget.init(options)

    .catch (error) ->
      console.error error

    $(button).on 'click.xsolla', ->
      Promise.all([init, trap]).then (values) ->
        window.requestAnimationFrame ->
          # FIXME: flickering when transitioning to widget
          XPayStationWidget.open()
          LoadingOverlay.hide()
