# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute'

class window.StoreSupporterTag
  RESOLUTION: 8
  MIN_VALUE: 4
  MAX_VALUE: 52

  @initialize: ->
    new StoreSupporterTag(elem) for elem in document.getElementsByClassName('js-store-supporter-tag')

  constructor: (rootElement) ->
    @debouncedGetUser = _.debounce @getUser, 300
    @el = rootElement
    @searching = false

    # Everything should be scoped under the root @el
    @priceElement = @el.querySelector('.js-price')
    @durationElement = @el.querySelector('.js-duration')
    @discountElement = @el.querySelector('.js-discount')
    @slider = @el.querySelector('.js-slider')
    @sliderPresets = @el.querySelectorAll('.js-slider-preset')
    @targetIdElement = @el.querySelector('input[name="item[extra_data][target_id]"]')
    @usernameInput = @el.querySelector('.js-username-input')

    @reactElement = @el.querySelector('.js-react--user-card-store')
    @user = JSON.parse(@reactElement.dataset.user)
    if !@user?
      @user = currentUser
      @reactElement.dataset.user = JSON.stringify(@user)

    $(document).one 'turbolinks:before-cache', =>
      @reactElement.dataset.user = JSON.stringify(@user)

    @cost = @calculate(@initializeSlider().slider('value'))
    @initializeSliderPresets()
    @initializeUsernameInput()
    @updateCostDisplay()

    # force initial values for consistency.
    @updateSearchResult()


  initializeSlider: =>
    # remove leftover from previous initialization
    $(@slider).find('.ui-slider-range').remove()

    $(@slider).slider
      range: 'min'
      value: @slider.dataset.lastValue ? @sliderValue(@MIN_VALUE)
      min: @sliderValue(@MIN_VALUE)
      max: @sliderValue(@MAX_VALUE)
      step: 1
      animate: true
      slide: @onSliderValueChanged
      change: @onSliderValueChanged


  initializeSliderPresets: =>
    $(@sliderPresets).on 'click', (event) =>
      target = event.currentTarget
      price = StoreSupporterTagPrice.durationToPrice(target.dataset.months)
      $(@slider).slider('value', @sliderValue(price)) if price


  initializeUsernameInput: =>
    $(@usernameInput).on 'input', @onInput


  getUser: (username) =>
    if !username # reset to current user on empty
      @user = window.currentUser
      @searching = false
      @updateSearchResult()
      return

    $.ajax
      data:
        username: username
      dataType: 'json',
      type: 'POST'
      url: route('users.check-username-exists')
    .done (data) =>
      @user = data

    .fail (xhr, status) =>
      $(@usernameInput)
        .trigger 'ajax:error', [xhr, status]
        .one 'click', @onInput

    .always =>
      @searching = false
      @updateSearchResult()


  calculate: (position) =>
    new StoreSupporterTagPrice(Math.floor(position / @RESOLUTION))


  onSliderValueChanged: (event, ui) =>
    @slider.dataset.lastValue = ui.value
    @cost = @calculate(ui.value)
    @updateCostDisplay()


  onInput: (event) =>
    if !@searching
      @searching = true
      @user = null
      @updateSearchResult()
    @debouncedGetUser(event.currentTarget.value)


  sliderValue: (price) ->
    price * @RESOLUTION


  updateCostDisplay: =>
    @el.querySelector('input[name="item[cost]"]').value = @cost.price()
    @priceElement.textContent = "USD #{@cost.price()}"
    @durationElement.textContent = @cost.durationText()
    @discountElement.textContent = @cost.discountText()
    @updateSliderPreset(elem, @cost) for elem in @sliderPresets


  updateSearchResult: =>
    $.publish 'store-supporter-tag:update-user', @user
    @updateTargetId()
    @updateUserInteraction()


  updateSliderPreset: (elem, cost) ->
    $(elem).toggleClass('js-slider-preset--active', cost.duration() >= +elem.dataset.months)


  updateTargetId: =>
    @targetIdElement.value = @user?.id


  updateUserInteraction: =>
    enabled = @user?.id? && Number.isFinite(@user.id) && @user.id > 0

    StoreCart.setEnabled(enabled)
    # TODO: need to elevate this element when switching over to new store design.
    $(@el).toggleClass('js-store--disabled', !enabled)
    $('.js-slider').slider('disabled': !enabled)
