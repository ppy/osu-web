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
    @searching = false
    @searchData = null
    @el = document.getElementById('js-store-support-osu')
    @currentUser = {
      username: @el.dataset.username
      avatar_url: @el.dataset.avatarUrl
    }
    # Everything should be scoped under the root @el
    @priceElement = @el.querySelector('.js-price')
    @durationElement = @el.querySelector('.js-duration')
    @pricePerMonthElement = @el.querySelector('.js-price-per-month')
    @discountElement = @el.querySelector('.js-discount')
    @slider = @el.querySelector('.js-slider')
    @usernameInput = @el.querySelector('#username.form-control')

    @debouncedGetUser = _.debounce @getUser, 300
    @initializeSlider()
    @initializeUsernameInput()
    $(@el.querySelectorAll('.js-gift-someone')).on 'click', =>
      @toggleMode()
    @

  initializeSlider: =>
    slider = $(@slider).slider {
      range: 'min',
      value: @MIN_VALUE * @RESOLUTION,
      min: @MIN_VALUE * @RESOLUTION,
      max: @MAX_VALUE * @RESOLUTION,
      slide: (event, ui) =>
        values = @calculate(ui.value)
        @updatePriceDisplay(values)
    }
    @updatePriceDisplay(@calculate(@MIN_VALUE * @RESOLUTION))
    slider

  initializeUsernameInput: =>
    $(@usernameInput).on 'input', (event) =>
      @onInput(event)

  getUser: (username) =>
    $.post '/users/check-username-exists', username: username
    .done (data) =>
      @updateSlider(data?)
      @updateUserDisplay(data)
    .fail (xhr) =>
      @updateSlider(false)
      @updateUserDisplay(null)
      if xhr.status == 401
        osu.popup osu.trans('errors.logged_out'), 'danger'
    .always =>
      console.log(@searching)
      @searching = false

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

  onInput: (event) =>
    if !@searching
      console.log(@searching)
      @searching = true
      # need to trigger immediately.
      # without setTimeout, some browsers might not trigger the class update
      # until after the debounce?
      setTimeout(() =>
        @updateSearchResult(true)
        @updateSlider(false)
      , 0)

    @debouncedGetUser(event.currentTarget.value)

  updateSearchResult: (searching) ->
    $('.js-error').text('searching') if searching

  updatePriceDisplay: (obj) =>
    @priceElement.textContent = "USD #{obj.price}"
    monthText = if (obj.duration == 1) then 'month' else 'months'
    @durationElement.textContent = "#{obj.duration} #{monthText}"
    @pricePerMonthElement.textContent = obj.pricePerMonth()
    @discountElement.textContent = obj.discount()

  updateUserDisplay: (user) =>
    avatarUrl = if user
                   $('.js-error').text('')
                   user.avatar_url
                 else
                   $('.js-error').text("This user doesn't exist!")
                   ''

    $(@el.querySelectorAll('.js-avatar')).css(
      'background-image': "url(#{avatarUrl})"
    )

  updateSlider: (enabled) =>
    $(@el).toggleClass('store-support-osu--disabled', !enabled)
    $('.js-slider').slider({ 'disabled': !enabled })
