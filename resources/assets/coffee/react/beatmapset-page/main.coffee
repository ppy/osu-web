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

{div} = ReactDOMFactories
el = React.createElement

class BeatmapsetPage.Main extends React.Component
  constructor: (props) ->
    super props

    @scoreboardXhr = null
    @favouriteXhr = null

    @state = JSON.parse(@props.container.dataset.state ? 'null')
    @restoredState = @state?

    if !@restoredState
      optionsHash = BeatmapsetPageHash.parse location.hash

      beatmaps = _.concat props.beatmapset.beatmaps, props.beatmapset.converts
      beatmaps = BeatmapHelper.group beatmaps

      currentBeatmap = BeatmapHelper.find
        group: beatmaps
        id: optionsHash.beatmapId
        mode: optionsHash.playmode

      # fall back to the first mode that has beatmaps in this mapset
      currentBeatmap ?= BeatmapHelper.default items: beatmaps[optionsHash.playmode]
      currentBeatmap ?= BeatmapHelper.default group: beatmaps

      @state =
        beatmaps: beatmaps
        currentBeatmap: currentBeatmap
        favcount: props.beatmapset.favourite_count
        hasFavourited: props.beatmapset.has_favourited
        loading: false
        currentScoreboardType: 'global'
        enabledMods: []
        scores: []
        userScore: null
        userScorePosition: -1


  setCurrentScoreboard: (_e, {
    scoreboardType = @state.currentScoreboardType,
    enabledMod = null,
    forceReload = false,
    resetMods = false
  }) =>
    @scoreboardXhr?.abort()

    @setState
      currentScoreboardType: scoreboardType

    if scoreboardType != 'global' && !currentUser.is_supporter
      @setState scores: []
      return

    enabledMods = if resetMods
      []
    else if enabledMod != null && _.includes @state.enabledMods, enabledMod
      _.without @state.enabledMods, enabledMod
    else if enabledMod != null
      _.concat @state.enabledMods, enabledMod
    else
      @state.enabledMods

    @scoresCache ?= {}
    cacheKey = "#{@state.currentBeatmap.id}-#{@state.currentBeatmap.mode}-#{_.sortBy enabledMods}-#{scoreboardType}"

    loadScore = =>
      @setState
        scores: @scoresCache[cacheKey].scores
        userScore: @scoresCache[cacheKey].userScore if @scoresCache[cacheKey].userScore?
        userScorePosition: @scoresCache[cacheKey].userScorePosition
        enabledMods: enabledMods

    if !forceReload && @scoresCache[cacheKey]?
      loadScore()
      return

    $.publish 'beatmapset:scoreboard:loading', true
    @setState loading: true

    @scoreboardXhr = $.ajax (laroute.route 'beatmaps.scores', beatmap: @state.currentBeatmap.id),
      method: 'GET'
      dataType: 'JSON'
      data:
        type: scoreboardType
        mods: enabledMods
        mode: @state.currentBeatmap.mode

    .done (data) =>
      @scoresCache[cacheKey] = data
      loadScore()

    .fail (xhr, status) =>
      if status == 'abort'
        return

      osu.ajaxError xhr

    .always =>
      $.publish 'beatmapset:scoreboard:loading', false
      @setState loading: false


  setCurrentBeatmap: (_e, {beatmap}) =>
    return unless beatmap?
    return if @state.currentBeatmap.id == beatmap.id && @state.currentBeatmap.mode == beatmap.mode

    @setState
      currentBeatmap: beatmap
      =>
        @setHash()
        @setCurrentScoreboard null, scoreboardType: 'global', resetMods: true


  setCurrentPlaymode: (_e, {mode}) =>
    return if @state.currentBeatmap.mode == mode

    @setCurrentBeatmap null,
      beatmap: BeatmapHelper.default items: @state.beatmaps[mode]


  setHoveredBeatmap: (_e, hoveredBeatmap) =>
    @setState hoveredBeatmap: hoveredBeatmap


  toggleFavourite: =>
    @favouriteXhr = $.ajax
      url: laroute.route('beatmapsets.update-favourite', beatmapset: @props.beatmapset.id)
      method: 'post'
      dataType: 'json'
      data:
        action: if @state.hasFavourited then 'unfavourite' else 'favourite'

    .done (data) =>
      @setState
        favcount: data.favcount
        hasFavourited: data.favourited

  componentDidMount: ->
    $.subscribe 'beatmapset:beatmap:set.beatmapsetPage', @setCurrentBeatmap
    $.subscribe 'playmode:set.beatmapsetPage', @setCurrentPlaymode
    $.subscribe 'beatmapset:scoreboard:set.beatmapsetPage', @setCurrentScoreboard
    $.subscribe 'beatmapset:hoveredbeatmap:set.beatmapsetPage', @setHoveredBeatmap
    $.subscribe 'beatmapset:favourite:toggle.beatmapsetPage', @toggleFavourite
    $(document).on 'turbolinks:before-cache.beatmapsetPage', @saveStateToContainer

    @setHash()

    if !@restoredState || @state.loading
      @setCurrentScoreboard null, scoreboardType: 'global', resetMods: true


  componentWillUnmount: ->
    $.unsubscribe '.beatmapsetPage'
    @scoreboardXhr?.abort()
    @favouriteXhr?.abort()


  render: ->
    div className: 'osu-layout osu-layout--full',
      div className: 'osu-layout__row osu-layout__row--page-compact',
        el BeatmapsetPage.Header,
          beatmapset: @props.beatmapset
          beatmaps: @state.beatmaps
          currentBeatmap: @state.currentBeatmap
          hoveredBeatmap: @state.hoveredBeatmap
          favcount: @state.favcount
          hasFavourited: @state.hasFavourited

        el BeatmapsetPage.Info,
          beatmapset: @props.beatmapset
          beatmap: @state.currentBeatmap

      div className: 'osu-layout__section osu-layout__section--extra',
        div className: 'osu-page osu-page--generic',
          el BeatmapsetPage.Scoreboard,
            type: @state.currentScoreboardType
            beatmap: @state.currentBeatmap
            scores: @state.scores
            userScore: @state.userScore?.score
            userScorePosition: @state.userScore?.position
            enabledMods: @state.enabledMods
            countries: @props.countries
            loading: @state.loading
            hasScores: @props.beatmapset.has_scores

        div className: 'osu-page osu-page--generic-compact',
          el Comments,
            commentableType: 'beatmapset'
            commentableId: @props.beatmapset.id


  saveStateToContainer: =>
    @props.container.dataset.state = JSON.stringify(@state)


  setHash: =>
    osu.setHash BeatmapsetPageHash.generate
      beatmap: @state.currentBeatmap
