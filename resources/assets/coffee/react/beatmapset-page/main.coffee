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

BeatmapsetPage.Main = React.createClass
  mixins: [ScrollingPageMixin]

  getInitialState: ->
    optionsHash = BeatmapsetPageHash.parse location.hash
    @initialPage = optionsHash.page

    currentMode = if optionsHash.mode then parseInt optionsHash.mode, 10 else @props.displayedBeatmap

    currentMode: currentMode
    currentPlaymode: @props.beatmaps[currentMode].mode
    currentScoreboard: 'global'
    scores: @props.beatmaps[currentMode].scoresBest.data
    loading: false

  setHash: ->
    osu.setHash BeatmapsetPageHash.generate page: @state.currentPage, mode: @state.currentMode

  setCurrentPlaymode: (_e, playmode) ->
    return if @state.currentPlaymode == playmode
    @setState currentPlaymode: playmode, @setHash

  setCurrentScoreboard: (_e, scoreboard) ->
    return if @state.loading

    if scoreboard == 'global'
      @setState scores: @props.beatmaps[@state.currentMode].scoresBest.data
      @setState currentScoreboard: scoreboard
    else
      if not currentUser.isSupporter
        @setState currentScoreboard: scoreboard
        return

      $.publish 'beatmapset:scoreboard:loading', true
      @setState loading: true

      $.ajax Url.beatmapScores(@state.currentMode),
        method: 'GET'
        dataType: 'JSON'
        data:
          type: scoreboard

      .done (data) =>
        @setState scores: data.data
        @setState currentScoreboard: scoreboard
      .fail (xhr) =>
        osu.ajaxError xhr
      .always =>
        $.publish 'beatmapset:scoreboard:loading', false
        @setState loading: false

  _setCurrentMode: (_e, mode) ->
    @setCurrentMode _e, mode

    @setState
      currentScoreboard: 'global'
      scores: @props.beatmaps[mode].scoresBest.data

  componentDidMount: ->
    @removeListeners()

    $.subscribe 'beatmapset:mode:set.beatmapSetPage', @_setCurrentMode
    $.subscribe 'beatmapset:playmode:set.beatmapSetPage', @setCurrentPlaymode
    $.subscribe 'beatmapset:page:jump.beatmapSetPage', @pageJump
    $.subscribe 'beatmapset:scoreboard:set.beatmapSetPage', @setCurrentScoreboard
    $(window).on 'throttled-scroll.beatmapSetPage', @pageScan

    @pageJump null, @initialPage


  componentWillUnmount: ->
    @removeListeners()


  removeListeners: ->
    $.unsubscribe '.beatmapSetPage'
    $(window).off '.beatmapSetPage'

  render: ->
    div className: 'osu-layout__section',
      el BeatmapsetPage.Header,
        title: @props.set.title
        artist: @props.set.artist
        playcount: @props.set.play_count
        favcount: @props.set.favourite_count
        cover: @props.set.covers.cover

      el BeatmapsetPage.Contents,
        set: @props.set
        beatmaps: @props.beatmaps
        beatmapsByMode: @props.beatmapsByMode
        beatmapCount: @props.beatmapCount
        currentPlaymode: @state.currentPlaymode
        currentMode: @state.currentMode
        currentPage: @state.currentPage

      el BeatmapsetPage.Extra,
        set: @props.set
        beatmaps: @props.beatmaps
        beatmap: @props.beatmaps[@state.currentMode]
        currentPage: @state.currentPage
        currentMode: @state.currentMode
        currentScoreboard: @state.currentScoreboard
        scores: @state.scores
        countries: @props.countries
