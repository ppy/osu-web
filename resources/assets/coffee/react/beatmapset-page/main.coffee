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

    beatmaps = _.keyBy @props.beatmapset.beatmaps.data, (o) -> o.id

    currentBeatmapId =
      if optionsHash.beatmapId? && beatmaps[optionsHash.beatmapId]?
        optionsHash.beatmapId
      else
        _.last(@props.beatmapset.beatmaps.data).id

    beatmaps: beatmaps
    beatmapsByMode: _.groupBy @props.beatmapset.beatmaps.data, (o) -> o.mode
    currentBeatmapId: currentBeatmapId
    currentPlaymode: beatmaps[currentBeatmapId].mode
    loading: false
    currentScoreboard: 'global'
    scores: []

  setHash: ->
    osu.setHash BeatmapsetPageHash.generate page: @state.currentPage, beatmapId: @state.currentBeatmapId

  setCurrentScoreboard: (_e, {scoreboard, forceReload = false}) ->
    return if @state.loading

    @setState
      currentScoreboard: scoreboard
      scores: []

    return if scoreboard != 'global' && !currentUser.isSupporter

    @scoresCache ?= {}
    cacheKey = "#{@state.currentBeatmapId}-#{scoreboard}"

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

    .done (data) =>
      @scoresCache[cacheKey] = data.data
      loadScore()

    .fail osu.ajaxError

    .always =>
      $.publish 'beatmapset:scoreboard:loading', false
      @setState loading: false


  setCurrentBeatmapId: (_e, beatmapId) ->
    return if @state.currentBeatmapId == beatmapId

    @setState
      currentBeatmapId: beatmapId
      currentPlaymode: @state.beatmaps[beatmapId].mode
      =>
        @setHash()
        @setCurrentScoreboard scoreboard: 'global'


  componentDidMount: ->
    @removeListeners()

    $.subscribe 'beatmapset:beatmap:set.beatmapSetPage', @setCurrentBeatmapId
    $.subscribe 'beatmapset:page:jump.beatmapSetPage', @pageJump
    $.subscribe 'beatmapset:scoreboard:set.beatmapSetPage', @setCurrentScoreboard

    @pageJump null, @initialPage
    @setCurrentScoreboard null, scoreboard: 'global'


  componentWillUnmount: ->
    @removeListeners()


  removeListeners: ->
    $.unsubscribe '.beatmapSetPage'

  render: ->
    div className: 'osu-layout__section',
      el BeatmapsetPage.Header,
        title: @props.beatmapset.title
        artist: @props.beatmapset.artist
        playcount: @props.beatmapset.play_count
        favcount: @props.beatmapset.favourite_count
        cover: @props.beatmapset.covers.cover

      el BeatmapsetPage.Contents,
        beatmapset: @props.beatmapset
        beatmaps: @state.beatmaps
        beatmapsByMode: @state.beatmapsByMode
        currentPlaymode: @state.currentPlaymode
        currentBeatmapId: @state.currentBeatmapId
        currentPage: @state.currentPage

      el BeatmapsetPage.Extra,
        beatmapset: @props.beatmapset
        beatmaps: @state.beatmaps
        beatmap: @state.beatmaps[@state.currentBeatmapId]
        currentPage: @state.currentPage
        currentBeatmapId: @state.currentBeatmapId
        currentScoreboard: @state.currentScoreboard
        scores: @state.scores
        countries: @props.countries
