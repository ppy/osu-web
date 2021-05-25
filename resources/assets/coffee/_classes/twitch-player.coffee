# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class @TwitchPlayer
  constructor: (@turbolinksReload) ->
    @playerDivs = document.getElementsByClassName('js-twitch-player')

    addEventListener 'turbolinks:load', @startAll


  initializeEmbed: =>
    @turbolinksReload
      .load 'https://player.twitch.tv/js/embed/v1.js'
      ?.then @startAll


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
