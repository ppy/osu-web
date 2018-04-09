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

class @StoreSupporterTagPrice
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
    (@_price / @duration()).toFixed(2)

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
      texts.push Lang.choice('common.count.years', duration.years)

    if duration.months > 0
      texts.push Lang.choice('common.count.months', duration.months)

    texts.join(', ')
