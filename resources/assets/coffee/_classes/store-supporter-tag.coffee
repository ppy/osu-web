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

    # Everything should be scoped under the root @el
    @priceElement = @el.querySelector('.js-price')
    @durationElement = @el.querySelector('.js-duration')
    @discountElement = @el.querySelector('.js-discount')
    @slider = @el.querySelector('.js-slider')
    @sliderPresets = @el.querySelectorAll('.js-slider-preset')
    @usernameInput = @el.querySelector('.js-username-input')
    @inputFeedback = @el.querySelector('.js-input-feedback')

    @user =
      userId: @el.dataset.userId
      username: @el.dataset.username
      avatarUrl: @el.dataset.avatarUrl

    @cost = @calculate(@initializeSlider().slider('value'))
    @initializeSliderPresets()
    @initializeUsernameInput()
    @updateCostDisplay()

  initializeSlider: =>
    $(@slider).slider
      range: 'min'
      value: @sliderValue(@MIN_VALUE)
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
    $.post laroute.route('users.check-username-exists'), username: username
    .done (data) =>
      # make a User DTO?
      @user =
        userId: data.user_id
        username: data.username
        avatarUrl: data.avatar_url

    .fail (xhr) =>
      @user = null
      if xhr.status == 401
        osu.popup osu.trans('errors.logged_out'), 'danger'

    .always =>
      @searching = false
      @updateSearchResult()

  calculate: (position) =>
    new StoreSupporterTagPrice(Math.floor(position / @RESOLUTION))

  onSliderValueChanged: (event, ui) =>
    @cost = @calculate(ui.value)
    @updateCostDisplay()

  onInput: (event) =>
    if !@searching
      @searching = true
      @updateSearchResult()
    @debouncedGetUser(event.currentTarget.value)

  setUserInteraction: (enabled) =>
    StoreCart.setEnabled(enabled)
    # TODO: need to elevate this element when switching over to new store design.
    $(@el).toggleClass('js-store--disabled', !enabled)
    $('.js-slider').slider('disabled': !enabled)

  sliderValue: (price) ->
    price * @RESOLUTION

  updateSearchResult: =>
    if @searching
      @inputFeedback.textContent = Lang.get('supporter_tag.user_search.searching')
      return @setUserInteraction(false)

    [avatarUrl, text] = if @user
                          [@user.avatarUrl, '']
                        else
                          ['', Lang.get("supporter_tag.user_search.not_found")]

    @inputFeedback.textContent = text
    # Avoid setting value to undefined
    @el.querySelector('input[name="item[extra_data][target_id]"').value = @user?.userId ? null
    $(@el.querySelectorAll('.js-avatar')).css
      'background-image': "url(#{avatarUrl})"

    @setUserInteraction(@user?)

  updateCostDisplay: =>
    @el.querySelector('input[name="item[cost]"]').value = @cost.price()
    @el.querySelector('input[name="item[extra_data][duration]"]').value = @cost.duration()
    @priceElement.textContent = "USD #{@cost.price()}"
    @durationElement.textContent = @cost.durationText()
    @discountElement.textContent = @cost.discountText()
    @updateSliderPreset(elem, @cost) for elem in @sliderPresets

  updateSliderPreset: (elem, cost) ->
    $(elem).toggleClass('js-slider-preset--active', cost.duration() >= +elem.dataset.months)
