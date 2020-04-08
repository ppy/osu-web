# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class @OsuAudio
  constructor: ->
    @_player = document.getElementsByClassName('js-audio')

    $(document).on 'click', '.js-audio--play', @play

    # attach onEnded event listener this way because it doesn't bubble
    # thus can't be attached to $(document)
    $(document).on 'turbolinks:load', =>
      @player().addEventListener 'playing', @playing
      @player().addEventListener 'ended', @stop
      @player().volume = 0.45


  play: (e) =>
    e.preventDefault()

    url = e.currentTarget.dataset.audioUrl

    if url == @urlGet()
      return @stop()

    @urlSet url
    @publish 'initializing'
    promise = @player().play()
    # old api returns undefined
    promise?.catch (error) ->
      return if error.name == 'AbortError' || error.name == 'NotSupportedError'
      throw error


  player: =>
    @_player[0]


  playing: =>
    @publish 'playing'


  publish: (event) =>
    $.publish "osuAudio:#{event}",
      url: @urlGet()
      player: @player()


  stop: =>
    @player().pause()
    @player().currentTime = 0
    @urlRemove()
    @publish 'ended'


  urlGet: =>
    @player().getAttribute 'src'


  urlSet: (url) =>
    @player().setAttribute 'src', url


  urlRemove: =>
    @player().removeAttribute 'src'
