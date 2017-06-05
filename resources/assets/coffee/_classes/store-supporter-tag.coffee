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

class @StoreSupporterTag
  RESOLUTION: 8
  MIN_VALUE: 4
  MAX_VALUE: 52

  @initialize: ->
    new StoreSupporterTag(elem) for elem in document.getElementsByClassName('js-store-supporter-tag')

  constructor: (rootElement) ->
    @debouncedGetUser = _.debounce @getUser, 300
    @el = rootElement
    @searching = false
    @searchData = null
    @currentUser =
      username: @el.dataset.username
      avatar_url: @el.dataset.avatarUrl

    # Everything should be scoped under the root @el
    @priceElement = @el.querySelector('.js-price')
    @durationElement = @el.querySelector('.js-duration')
    @discountElement = @el.querySelector('.js-discount')
    @slider = @el.querySelector('.js-slider')
    @sliderPresets = @el.querySelectorAll('.js-slider-preset')
    @usernameInput = @el.querySelector('.js-username-input')

    @initializeSlider()
    @initializeSliderPresets()
    @initializeUsernameInput()

  initializeSlider: =>
    slider = $(@slider).slider {
      range: 'min',
      value: @sliderValue(@MIN_VALUE),
      min: @sliderValue(@MIN_VALUE),
      max: @sliderValue(@MAX_VALUE),
      step: 1,
      animate: true,
      slide: @onSliderValueChanged,
      change: @onSliderValueChanged,
    }
    @updatePrice(@calculate(@sliderValue(@MIN_VALUE)))
    slider

  initializeSliderPresets: =>
    $(@sliderPresets).on 'click', (event) =>
      target = event.currentTarget
      price = StoreSupporterTagPrice.durationToPrice(target.dataset.months)
      $(@slider).slider('value', @sliderValue(price)) if price

  initializeUsernameInput: =>
    $(@usernameInput).on 'input', @onInput

  getUser: (username) =>
    $.post laroute.route('users.check-username-exists'), username: username
    .done (data) =>
      @setUserInteraction(data?)
      @updateUserDisplay(data)
      @updateCart(data)
    .fail (xhr) =>
      @setUserInteraction(false)
      @updateUserDisplay(null)
      @updateCart(null)
      if xhr.status == 401
        osu.popup osu.trans('errors.logged_out'), 'danger'
    .always =>
      @searching = false

  calculate: (position) =>
    new StoreSupporterTagPrice(Math.floor(position / @RESOLUTION))

  onSliderValueChanged: (event, ui) =>
    values = @calculate(ui.value)
    @updatePrice(values)
    @updateSliderPresets(values)

  onInput: (event) =>
    if !@searching
      @searching = true
      @updateSearchResult(true)
      @setUserInteraction(false)
    @debouncedGetUser(event.currentTarget.value)

  sliderValue: (price) ->
    price * @RESOLUTION

  updateCart: (data) ->
    # FIXME: should consolidate implementations into a service class.
    disabled = !data?
    $('.js-store-add-to-cart').prop 'disabled', disabled
    $('#product-form').data 'disabled', disabled

  updateSearchResult: (searching) ->
    $('.js-input-feedback').text('searching') if searching

  updatePrice: (obj) =>
    @el.querySelector('input[name="item[cost]"').value = obj.price()
    @el.querySelector('input[name="item[extra_data][duration]"').value = obj.duration()
    @priceElement.textContent = "USD #{obj.price()}"
    @durationElement.textContent = obj.durationText()
    @discountElement.textContent = "save #{obj.discount()}%"

  updateUserDisplay: (user) =>
    avatarUrl = if user
                  $('.js-input-feedback').text('')
                  user.avatar_url
                else
                  $('.js-input-feedback').text("This user doesn't exist")
                  ''

    $(@el.querySelectorAll('.js-avatar')).css(
      'background-image': "url(#{avatarUrl})"
    )

  setUserInteraction: (enabled) =>
    $(@el).toggleClass('store-supporter-tag--disabled', !enabled)
    $('.js-slider').slider({ 'disabled': !enabled })

  updateSliderPresets: (values) =>
    @updateSliderPreset(elem, values) for elem in @sliderPresets

  updateSliderPreset: (elem, values) ->
    $(elem).toggleClass('store-slider__preset--active', values.duration() >= +elem.dataset.months)
