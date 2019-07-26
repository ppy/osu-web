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
    @urlSet ''
    @publish 'ended'


  urlGet: =>
    @player().getAttribute 'src'


  urlSet: (url) =>
    @player().setAttribute 'src', url
