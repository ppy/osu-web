###
# Copyright 2016 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
{div, p, button} = React.DOM
el = React.createElement

class ProductPage.AddToCart extends React.Component
  constructor: (props) ->
    super props

    @state =
      stock: @props.product.stock
      requestedNotification: @props.requestedNotification

  requestNotification: =>
    LoadingOverlay.show()

    $.ajax Url.requestProductNotification(@props.product.product_id),
      method: 'POST'
      dataType: 'JSON'

    .done (data) =>
      @setState requestedNotification: data.ok

    .fail (xhr) =>
      osu.ajaxError xhr

    .always LoadingOverlay.hide()


  render: ->
    div
      className: 'osu-layout__sub-row osu-layout__sub-row--with-separator'
      id: 'add-to-cart'

      if @state.stock
        div className: 'big-button',
          button
            type: 'submit'
            className: 'js-store-add-to-cart btn-osu btn-osu-default'
            Lang.get 'store.product.add-to-cart'
      else
        if @state.requestedNotification
          div className: 'store-notification-requested-alert',
            el Icon, name: 'check-circle-o', modifier: 'store-notification-requested-alert__icon'
            p className: 'store-notification-requested-alert__text', Lang.get 'store.product.notification-success'
        else
          div className: 'big-button',
            button
              type: 'button'
              className: 'btn-osu btn-osu-default'
              onClick: @requestNotification
              Lang.get 'store.product.notify'
