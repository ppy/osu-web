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

    beatmaps = _.keyBy @props.set.beatmaps.data, (o) -> o.id

    currentMode =
      if optionsHash.mode? && beatmaps[optionsHash.mode]?
        optionsHash.mode
      else
        _.last(@props.set.beatmaps.data).id

    beatmaps: beatmaps
    beatmapsByMode: _.groupBy @props.set.beatmaps.data, (o) -> o.mode
    currentMode: currentMode
    currentPlaymode: beatmaps[currentMode].mode
    currentScoreboard: 'global'
    scores: beatmaps[currentMode].scoresBest.data
    loading: false

  setHash: ->
    osu.setHash BeatmapsetPageHash.generate page: @state.currentPage, mode: @state.currentMode

  setCurrentScoreboard: (_e, scoreboard) ->
    return if @state.loading

    if scoreboard == 'global'
      @setState scores: @state.beatmaps[@state.currentMode].scoresBest.data
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

  _setCurrentMode: (_e, beatmapId) ->
    @setCurrentMode _e, beatmapId

    @setState
      currentPlaymode: @state.beatmaps[beatmapId].mode
      currentScoreboard: 'global'
      scores: @state.beatmaps[beatmapId].scoresBest.data

  componentDidMount: ->
    @removeListeners()

    $.subscribe 'beatmapset:beatmap:set.beatmapSetPage', @_setCurrentMode
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
        beatmaps: @state.beatmaps
        beatmapsByMode: @state.beatmapsByMode
        currentPlaymode: @state.currentPlaymode
        currentMode: @state.currentMode
        currentPage: @state.currentPage

      el BeatmapsetPage.Extra,
        set: @props.set
        beatmaps: @state.beatmaps
        beatmap: @state.beatmaps[@state.currentMode]
        currentPage: @state.currentPage
        currentMode: @state.currentMode
        currentScoreboard: @state.currentScoreboard
        scores: @state.scores
        countries: @props.countries
