###
# Copyright 2015-2016 ppy Pty. Ltd.
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

class BeatmapsetPage.Main extends React.Component
  constructor: (props) ->
    super props

    optionsHash = BeatmapsetPageHash.parse location.hash
    @initialPage = optionsHash.page

    beatmaps = _.concat props.beatmapset.beatmaps.data, props.beatmapset.converts.data
    beatmaps = _.sortBy beatmaps, ['convert', 'difficulty_rating']

    # group beatmaps by playmode and then by beatmap id
    beatmaps = _.groupBy beatmaps, 'mode'
    # contains the beatmap ids in their appropriate order
    beatmapList = {}

    for key, val of beatmaps
      beatmaps[key] = _.keyBy val, 'id'
      beatmapList[key] = _.map val, 'id'

    if beatmaps[optionsHash.playmode]? && beatmaps[optionsHash.playmode][optionsHash.beatmapId]?
      currentBeatmapId = optionsHash.beatmapId
      currentPlaymode = optionsHash.playmode

    # fall back to the first mode that has beatmaps in this mapset
    if !currentBeatmapId?
      for mode in BeatmapHelper.modes
        if beatmapList[mode]?
          currentBeatmapId = _.last beatmapList[mode]
          currentPlaymode = mode
          break

    @state =
      beatmaps: beatmaps
      beatmapList: beatmapList
      currentBeatmapId: currentBeatmapId
      currentPlaymode: currentPlaymode
      loading: false
      isPreviewPlaying: false
      currentScoreboardType: 'global'
      scores: []

  setHash: =>
    osu.setHash BeatmapsetPageHash.generate
      beatmapId: @state.currentBeatmapId
      playmode: @state.currentPlaymode

  setCurrentScoreboardType: (_e, {scoreboardType, forceReload = false}) =>
    return if @state.loading

    @setState
      currentScoreboardType: scoreboardType
      scores: []

    return if scoreboardType != 'global' && !currentUser.isSupporter

    @scoresCache ?= {}
    cacheKey = "#{@state.currentBeatmapId}-#{@state.currentPlaymode}-#{scoreboardType}"

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
        type: scoreboardType
        mode: @state.currentPlaymode

    .done (data) =>
      @scoresCache[cacheKey] = data.data
      loadScore()

    .fail osu.ajaxError

    .always =>
      $.publish 'beatmapset:scoreboard:loading', false
      @setState loading: false


  setCurrentBeatmapId: (_e, {beatmapId, playmode}) =>
    return if @state.currentBeatmapId == beatmapId && @state.currentPlaymode == playmode

    @setState
      currentBeatmapId: beatmapId
      currentPlaymode: playmode
      =>
        @setHash()
        @setCurrentScoreboardType null, scoreboardType: 'global'

  togglePreviewPlayingState: (_e, isPreviewPlaying) =>
    @setState isPreviewPlaying: isPreviewPlaying

    if isPreviewPlaying
      @audioPreview.play()
    else
      @audioPreview.pause()
      @audioPreview.currentTime = 0;

  setHoveredBeatmapId: (_e, hoveredBeatmapId) =>
    @setState hoveredBeatmapId: hoveredBeatmapId

  onPreviewEnded: =>
    @setState isPreviewPlaying: false

  componentDidMount: ->
    @removeListeners()

    $.subscribe 'beatmapset:beatmap:set.beatmapsetPage', @setCurrentBeatmapId
    $.subscribe 'beatmapset:scoreboard-type:set.beatmapsetPage', @setCurrentScoreboardType
    $.subscribe 'beatmapset:preview:toggle.beatmapsetPage', @togglePreviewPlayingState
    $.subscribe 'beatmapset:hoveredbeatmap:set.beatmapsetPage', @setHoveredBeatmapId

    @setHash()
    @setCurrentScoreboardType null, scoreboardType: 'global'

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
        beatmapset: @props.beatmapset
        beatmaps: @state.beatmaps
        beatmapList: @state.beatmapList
        currentBeatmap: currentBeatmap
        hoveredBeatmap: @state.beatmaps[@state.currentPlaymode][@state.hoveredBeatmapId]
        playcount: @props.beatmapset.play_count
        favcount: @props.beatmapset.favourite_count

      el BeatmapsetPage.Info,
        beatmapset: @props.beatmapset
        beatmap: currentBeatmap

      div className: 'osu-layout__section osu-layout__section--extra',
        el BeatmapsetPage.Scoreboard,
          currentType: @state.currentScoreboardType
          scores: @state.scores
