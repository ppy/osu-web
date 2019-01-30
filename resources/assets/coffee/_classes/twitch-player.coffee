###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

class @TwitchPlayer
  constructor: (@turbolinksReload) ->
    @playerDivs = document.getElementsByClassName('js-twitch-player')

    addEventListener 'turbolinks:load', @startAll


  initializeEmbed: =>
    @turbolinksReload.load 'https://player.twitch.tv/js/embed/v1.js', @startAll


  startAll: =>
    return if @playerDivs.length == 0

    if !Twitch?
      @initializeEmbed()
    else
      @start(div) for div in @playerDivs


  start: (div) =>
    return if div.dataset.twitchPlayerStarted

    div.dataset.twitchPlayerStarted = true
    options =
      width: '100%'
      height: '100%'
      channel: div.dataset.channel

    player = new Twitch.Player(div.id, options)
    player.addEventListener Twitch.Player.PLAY, => @openPlayer(div)


  noCookieDiv: (playerDivId) =>
    document.querySelector(".js-twitch-player--no-cookie[data-player-id='#{playerDivId}']")


  openPlayer: (div) =>
    return unless div.classList.contains 'hidden'

    div.classList.remove 'hidden'
    Fade.out @noCookieDiv(div.id)
