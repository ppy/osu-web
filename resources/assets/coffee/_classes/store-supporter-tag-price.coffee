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
  constructor: (price) ->
    @_price = price

  price: ->
    @_price

  duration: ->
    @_duration ||= switch
      when @_price < 1 then 0
      when @_price < 8 then 1
      when @_price < 12 then 2
      when @_price < 16 then 4
      when @_price < 20 then 6
      when @_price < 22 then 8
      when @_price < 24 then 9
      when @_price < 25 then 10
      else
        Math.floor(@_price / 26.0 * 12)

  pricePerMonth: ->
    (@_price / @duration()).toFixed(2)
  discount: ->
    raw = if @duration() >= 12 then 46 else ((1 - (@_price / @duration()) / 4) * 100)
    Math.max(0, Math.round(raw, 0))
  durationInYears: ->
    { years: Math.floor(@duration() / 12), months: Math.floor(@duration() % 12) }
  durationText: ->
    obj = @durationInYears()
    yearsText = switch obj.years
                when 0
                  ''
                when 1
                  "#{obj.years} year"
                else
                  "#{obj.years} years"

    monthsText = switch obj.months
                when 0
                  ''
                when 1
                  "#{obj.months} month"
                else
                  "#{obj.months} months"

    _.compact([yearsText, monthsText]).join(', ')
