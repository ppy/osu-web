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
class @TwitchPlayer
  constructor: ->
    @playerDivs = document.getElementsByClassName('js-twitch-player')
    @players = {}

    $(document).on 'turbolinks:load', @startAll


  startAll: =>
    for div in @playerDivs
      @players[div.id] ?= @start(div)


  start: (div) =>
    options =
      width: '100%'
      height: '100%'
      channel: div.dataset.channel

    player = new Twitch.Player(div.id, options)
    player.addEventListener 'playing', => @openPlayer(div)
    player


  noCookieDiv: (playerDivId) =>
    document.querySelector(".js-twitch-player--no-cookie[data-player-id='#{playerDivId}']")


  openPlayer: (div) =>
    return if !div.classList.contains 'hidden'

    div.classList.remove 'hidden' for div in @playerDivs
    Fade.out @noCookieDiv(div.id)
