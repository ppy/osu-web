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

class @StoreSupportOsu
  RESOLUTION: 8
  MIN_VALUE: 4
  MAX_VALUE: 52

  @Price = {
    price: 0
    duration: 0
    pricePerMonth: ->
      (@price / @duration).toFixed(2)
    discount: ->
      raw = if @duration >= 12 then 46 else ((1 - (@price / @duration) / 4) * 100)
      Math.round(raw, 0)
  }

  constructor: ->
    $(document).on 'turbolinks:load', @initialize

  initialize: =>
    console.debug('init')
    @el = document.getElementById('js-store-support-osu-player')
    @priceElement = @el.querySelector('.js-price')
    @durationElement = @el.querySelector('.js-duration')
    @pricePerMonthElement = @el.querySelector('.js-price-per-month')
    @discountElement = @el.querySelector('.js-discount')
    @slider = @el.querySelector('.js-slider')

    @initializeSlider()

  initializeSlider: =>
    $(@slider).slider {
      range: 'min',
      value: @MIN_VALUE * @RESOLUTION,
      min: @MIN_VALUE * @RESOLUTION,
      max: @MAX_VALUE * @RESOLUTION,
      slide: (event, ui) =>
        values = @calculate(ui.value)
        @updateDisplay(values)
    }

  calculate: (position) =>
    cost = Math.floor(position / @RESOLUTION)
    values = switch
      when cost < @MIN_VALUE then { price: @MIN_VALUE, duration: 0 }
      when cost < 8 then { price: 4, duration: 1 }
      when cost < 12 then { price: 8, duration: 2 }
      when cost < 16 then { price: 12, duration: 4 }
      when cost < 20 then { price: 16, duration: 6 }
      when cost < 22 then { price: 20, duration: 8 }
      when cost < 24 then { price: 22, duration: 9 }
      when cost < 26 then { price: 24, duration: 10 }
      else
        months = 0
        while ((months + 1) / 12 * 26 <= cost)
          months++
        { price: cost, duration: months }

    Object.assign(Object.create(StoreSupportOsu.Price), values)

  updateDisplay: (obj) =>
    @priceElement.textContent = obj.price
    @durationElement.textContent = obj.duration
    @pricePerMonthElement.textContent = obj.pricePerMonth()
    @discountElement.textContent = obj.discount()
