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

class @YtLoop
  constructor: ->
    @els = document.getElementsByClassName('js-yt-loop')

    $(document).on 'turbolinks:load', @boot


  boot: =>
    return if !@els[0]?

    if YT?
      @loadAll()
    else
      yt = document.createElement('script')
      yt.src = 'https://www.youtube.com/iframe_api'
      firstScriptTag = document.getElementsByTagName('script')[0]
      firstScriptTag.parentNode.insertBefore yt, firstScriptTag

      window.onYouTubeIframeAPIReady = => @loadAll()


  load: (el) =>
    videoId = el.dataset.ytLoopVideoId

    return if !videoId? || videoId == ''

    options =
      playerVars:
        controls: 0
        disablekb: 1
        modestbranding: 1
      videoId: videoId
      events:
        onReady: (e) ->
          e.target.mute()
          e.target.playVideo()
        onStateChange: (e) ->
          if e.data == YT.PlayerState.ENDED
            e.target.seekTo(0)

    $iframe = $('<div>', class: el.dataset.ytLoopClass)
    $(el).html('').append($iframe)

    el.player = new YT.Player($iframe[0], options)


  loadAll: =>
    @load(el) for el in @els
