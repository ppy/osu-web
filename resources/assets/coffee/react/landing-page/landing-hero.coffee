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

$('.js-landing-hero-slider').slick
  fade: true
  arrows: false
  autoplay: true
  adaptiveHeight: true


$('.landing-slide__bg').each ->
  $this = $(this)
  $slideSrc = $this.find('.landing-slide__bg--image').attr('src')
  $this.css 'background', 'url(\'' + $slideSrc + '\') no-repeat center center / cover'
  return 

getOS = ->
  nAgnt = navigator.userAgent
  os = undefined
  if /Windows (.*)/.test(nAgnt)
    return 'Windows'
  # Test for mobile first
  if /Mobile|mini|Fennec|Android|iP(ad|od|hone)/.test(navigator.appVersion)
    return 'Windows'
  if /(macOS|Mac OS X|MacPPC|MacIntel|Mac_PowerPC|Macintosh)/.test(nAgnt)
    return 'macOS'
  if /(Linux|X11)/.test(nAgnt)
    return 'Linux'
  'Windows'

otherOS = (os) ->
  choices = ['macOS', 'Linux', 'Windows']
  index = choices.indexOf os
  return choices.splice choices, 1

os = getOS()
others = otherOS os
$('.js-download-platform').text Lang.get('home.landing.download.for', {'os': os})
$('.js-download-other').text Lang.get('home.landing.download.other', {'os1': others[0], 'os2': others[1]})
