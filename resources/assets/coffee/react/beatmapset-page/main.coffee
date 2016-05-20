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
{div, audio} = React.DOM
el = React.createElement

BeatmapsetPage.Main = React.createClass
  mixins: [ScrollingPageMixin]

  getInitialState: ->
    optionsHash = BeatmapsetPageHash.parse location.hash
    @initialPage = optionsHash.page

    beatmaps = _.concat @props.beatmapset.beatmaps.data, @props.beatmapset.converts.data
    beatmaps = _.sortBy beatmaps, ['convert', 'difficulty_rating']

    # group beatmaps by playmode and then by beatmap id
    beatmaps = _.groupBy beatmaps, (o) -> o.mode
    # contains the beatmap ids in their appropriate order
    beatmapList = {}
    _.map beatmaps, (val, key) ->
      beatmaps[key] = _.keyBy val, (o) -> o.id
      beatmapList[key] = _.map val, (o) -> o.id

    [currentBeatmapId, currentPlaymode] =
      if beatmaps[optionsHash.playmode]? && beatmaps[optionsHash.playmode][optionsHash.beatmapId]?
        [optionsHash.beatmapId, optionsHash.playmode]
      else
        # falling back to standard for now
        [_.last(beatmapList.osu), 'osu']

    beatmaps: beatmaps
    beatmapList: beatmapList
    currentBeatmapId: currentBeatmapId
    currentPlaymode: currentPlaymode
    loading: false
    isPreviewPlaying: false
    currentScoreboard: 'global'
    scores: []

  setHash: ->
    osu.setHash BeatmapsetPageHash.generate
      page: @state.currentPage
      beatmapId: @state.currentBeatmapId
      playmode: @state.currentPlaymode

  setCurrentScoreboard: (_e, {scoreboard, forceReload = false}) ->
    return if @state.loading

    @setState
      currentScoreboard: scoreboard
      scores: []

    return if scoreboard != 'global' && !currentUser.isSupporter

    @scoresCache ?= {}
    cacheKey = "#{@state.currentBeatmapId}-#{@state.currentPlaymode}-#{scoreboard}"

    loadScore = =>
      @setState scores: @scoresCache[cacheKey]

    if !forceReload && @scoresCache[cacheKey]?
      loadScore()
      return

    $.publish 'beatmapset:scoreboard:loading', true
    @setState loading: true

    $.ajax (laroute.route 'beatmaps.scores', beatmaps: @state.currentBeatmapId),
      method: 'GET'
      dataType: 'JSON'
      data:
        type: scoreboard
        mode: @state.currentPlaymode

    .done (data) =>
      @scoresCache[cacheKey] = data.data
      loadScore()

    .fail osu.ajaxError

    .always =>
      $.publish 'beatmapset:scoreboard:loading', false
      @setState loading: false


  setCurrentBeatmapId: (_e, {beatmapId, playmode}) ->
    return if @state.currentBeatmapId == beatmapId && @state.currentPlaymode == playmode

    @setState
      currentBeatmapId: beatmapId
      currentPlaymode: playmode
      =>
        @setHash()
        @setCurrentScoreboard null, scoreboard: 'global'

  togglePreviewPlayingState: (_e, isPreviewPlaying) ->
    @setState isPreviewPlaying: isPreviewPlaying

    if isPreviewPlaying
      @audioPreview.play()
    else
      @audioPreview.pause()
      @audioPreview.currentTime = 0;

  onPreviewEnded: ->
    @setState isPreviewPlaying: false

  componentDidMount: ->
    @removeListeners()

    $.subscribe 'beatmapset:beatmap:set.beatmapsetPage', @setCurrentBeatmapId
    $.subscribe 'beatmapset:page:jump.beatmapsetPage', @pageJump
    $.subscribe 'beatmapset:scoreboard:set.beatmapsetPage', @setCurrentScoreboard
    $.subscribe 'beatmapset:preview:toggle.beatmapsetPage', @togglePreviewPlayingState

    @pageJump null, @initialPage
    @setCurrentScoreboard null, scoreboard: 'global'

    @audioPreview = document.getElementsByClassName('js-beatmapset-page--audio-preview')[0]

  componentWillUnmount: ->
    @removeListeners()


  removeListeners: ->
    $.unsubscribe '.beatmapsetPage'

  render: ->
    currentBeatmap = @state.beatmaps[@state.currentPlaymode][@state.currentBeatmapId]

    div className: 'osu-layout__section',
      audio
        className: 'js-beatmapset-page--audio-preview'
        src: @props.beatmapset.previewUrl
        preload: 'auto'
        onEnded: @onPreviewEnded

      el BeatmapsetPage.Header,
        title: @props.beatmapset.title
        artist: @props.beatmapset.artist
        playcount: @props.beatmapset.play_count
        favcount: @props.beatmapset.favourite_count
        cover: @props.beatmapset.covers.cover
        isPreviewPlaying: @state.isPreviewPlaying

      el BeatmapsetPage.Contents,
        beatmapset: @props.beatmapset
        currentBeatmap: currentBeatmap
        beatmaps: @state.beatmaps
        beatmapList: @state.beatmapList
        currentPage: @state.currentPage

      el BeatmapsetPage.Extra,
        beatmapset: @props.beatmapset
        beatmaps: @state.beatmaps
        currentBeatmap: currentBeatmap
        currentPage: @state.currentPage
        currentScoreboard: @state.currentScoreboard
        scores: @state.scores
        countries: @props.countries
