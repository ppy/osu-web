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

$('.landing-hero-slider').slick
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
  if navigator.appVersion.indexOf('Win') != -1
    return 'Windows'
  if navigator.appVersion.indexOf('Mac') != -1
    return 'Mac'
  if navigator.appVersion.indexOf('Linux') != -1
    return 'Linux'
  'Windows'

os = getOS()
$('.js-download-platform').text Lang.get('home.landing.download.for' + os)
$('.js-download-other').text Lang.get('home.landing.download.other' + os)