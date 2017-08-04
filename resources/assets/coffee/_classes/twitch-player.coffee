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

class @TwitchPlayer
  constructor: ->
    @playerDivs = document.getElementsByClassName('js-twitch-player')
    @embedInitialized = false

    addEventListener 'turbolinks:load', @startAll


  initializeEmbed: =>
    return if @embedInitialized

    @embedInitialized = true
    $embed = $('<script src="https://player.twitch.tv/js/embed/v1.js">')
    $(document.body).append $embed
    Timeout.set 0, -> $embed.remove()


  startAll: =>
    # wait until the twitch embed js is loaded
    if !Twitch? && @playerDivs[0]?
      @initializeEmbed()
      Timeout.set 500, @startAll
      return

    @start(div) for div in @playerDivs


  start: (div) =>
    return if div.dataset.twitchPlayerStarted

    div.dataset.twitchPlayerStarted = true
    options =
      width: '100%'
      height: '100%'
      channel: div.dataset.channel

    player = new Twitch.Player(div.id, options)
    player.addEventListener Twitch.Player.PLAY, @openPlayer


  noCookieDiv: (playerDivId) =>
    document.querySelector(".js-twitch-player--no-cookie[data-player-id='#{playerDivId}']")


  openPlayer: =>
    for div in @playerDivs
      return unless div.classList.contains 'hidden'

      div.classList.remove 'hidden'
      Fade.out @noCookieDiv(div.id)
