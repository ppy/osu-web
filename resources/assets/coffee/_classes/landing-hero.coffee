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

class @LandingHero
  constructor: ->
    @el =
      platformCurrent: document.getElementsByClassName('js-download-platform')
      platformOther: document.getElementsByClassName('js-download-other')

    $(document).on 'turbolinks:load', @initialize


  initialize: =>
    return if !@el.platformCurrent[0]?

    os = osu.getOS()
    others = osu.otherOS os
    @el.platformCurrent[0].innerText = osu.trans 'home.landing.download.for', os: os
    @el.platformOther[0].innerText = osu.trans 'home.landing.download.other', os1: others[0], os2: others[1]
