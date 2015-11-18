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
class @AdjustFooter
  footer: document.getElementsByClassName('js-page-footer-padding')
  fixedBottomBar: document.getElementsByClassName('js-fixed-bottom-bar')

  constructor: ->
    $(document).on 'ready page:load', @adjust
    $(window).on 'resize', _.throttle(@adjust, 500)
    $.subscribe 'fixedBottomBar:update', @adjust

    @adjust()


  adjust: =>
    @footer[0].style.paddingBottom = @barHeight()

  barHeight: =>
    if @fixedBottomBar.length
      getComputedStyle(@fixedBottomBar[0]).height
    else
      "0px"
