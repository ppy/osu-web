###
# Copyright 2016 ppy Pty. Ltd.
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
{div} = React.DOM
el = React.createElement

class BeatmapSetPage.Main extends SwitchableModePage
  constructor: (props) ->
    super props

    optionsHash = BeatmapSetPageHash.parse location.hash
    @initialPage = optionsHash.page
    @timeouts = {}

    currentMode = if optionsHash.mode then parseInt optionsHash.mode, 10 else props.displayedBeatmap

    @state =
      currentMode: currentMode
      currentPlaymode: props.beatmaps[currentMode].mode

  setHash: ->
    History.setHash BeatmapSetPageHash.generate page: @state.currentPage, mode: @state.currentMode

  setCurrentPlaymode: (_e, playmode) =>
    return if @state.currentPlaymode == playmode
    @setState currentPlaymode: playmode, @setHash

  componentDidMount: ->
    @removeListeners()

    $.subscribe 'beatmapset:mode:set.beatmapSetPage', @setCurrentMode
    $.subscribe 'beatmapset:playmode:set.beatmapSetPage', @setCurrentPlaymode
    $.subscribe 'beatmapset:page:jump.beatmapSetPage', @pageJump
    $(window).on 'throttled-scroll.beatmapSetPage', @pageScan

    @pageJump null, @initialPage


  componentWillUnmount: ->
    for own _name, timeout of @timeouts
      clearTimeout timeout

    @removeListeners()


  removeListeners: ->
    $.unsubscribe '.beatmapSetPage'
    $(window).off '.beatmapSetPage'

  render: ->
    div className: 'osu-layout__section',
      el BeatmapSetPage.Header,
        title: @props.set.title
        artist: @props.set.artist
        playcount: @props.set.play_count
        favcount: @props.set.favourite_count
        cover: @props.set.covers.cover

      el BeatmapSetPage.Contents,
        set: @props.set
        beatmaps: @props.beatmaps
        beatmapsByMode: @props.beatmapsByMode
        beatmapCount: @props.beatmapCount
        currentPlaymode: @state.currentPlaymode
        currentMode: @state.currentMode
        currentPage: @state.currentPage

      el BeatmapSetPage.Extra,
        set: @props.set
        beatmap: @props.beatmaps[@state.currentMode]
        currentPage: @state.currentPage
        currentMode: @state.currentMode
