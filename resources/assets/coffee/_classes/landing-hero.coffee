###
# Copyright 2015 ppy Pty. Ltd.
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

class @LandingHero
  constructor: ->
    $(document).on 'turbolinks:load', @initialize
    $(document).on 'turbolinks:before-cache', @remove


  initialize: =>
    $('.js-landing-hero-slider')
      .slick
        fade: true
        arrows: false
        autoplay: true
        adaptiveHeight: true
        dots: true
        appendDots: $('.js-landing-header')

    os = osu.getOS()
    others = osu.otherOS os
    $('.js-download-platform').text Lang.get('home.landing.download.for', {'os': os})
    $('.js-download-other').text Lang.get('home.landing.download.other', {'os1': others[0], 'os2': others[1]})


  remove: =>
    $('.js-landing-hero-slider').slick('unslick')
