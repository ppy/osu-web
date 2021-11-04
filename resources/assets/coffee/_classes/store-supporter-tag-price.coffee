# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class window.StoreSupporterTagPrice
  @durationToPrice: (duration) ->
    duration = +duration
    switch
      when duration >= 12 then Math.ceil(duration / 12.0 * 26)
      when duration == 10 then 24
      when duration == 9 then 22
      when duration == 8 then 20
      when duration == 6 then 16
      when duration == 4 then 12
      when duration == 2 then 8
      when duration == 1 then 4

  constructor: (price) ->
    @_price = price

  price: ->
    @_price

  duration: ->
    @_duration ?= switch
      when @_price >= 26 then Math.floor(@_price / 26.0 * 12)
      when @_price >= 24 then 10
      when @_price >= 22 then 9
      when @_price >= 20 then 8
      when @_price >= 16 then 6
      when @_price >= 12 then 4
      when @_price >= 8 then 2
      when @_price >= 4 then 1
      else 0

  pricePerMonth: ->
    osu.formatNumber(@_price / @duration(), 2)

  discount: ->
    if @duration() >= 12
      46
    else
      raw = ((1 - (@_price / @duration()) / 4) * 100)
      Math.max(0, Math.round(raw, 0))

  discountText: ->
    osu.trans('store.discount', percent: @discount())

  durationInYears: ->
    years: Math.floor(@duration() / 12)
    months: Math.floor(@duration() % 12)

  durationText: ->
    # don't forget to update SupporterTag::getDurationText() in php
    duration = @durationInYears()
    texts = []

    if duration.years > 0
      texts.push osu.transChoice('common.count.years', duration.years)

    if duration.months > 0
      texts.push osu.transChoice('common.count.months', duration.months)

    texts.join(', ')
