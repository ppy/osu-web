###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import { Header } from './header'
import { Hype } from './hype'
import { Info } from './info'
import { Scoreboard } from './scoreboard'
import { Comments } from 'comments'
import { CommentsManager } from 'comments-manager'
import * as React from 'react'
import { div } from 'react-dom-factories'
el = React.createElement

export class Main extends React.Component
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
      url: laroute.route('beatmapsets.favourites.store', beatmapset: @props.beatmapset.id)
      method: 'post'
      dataType: 'json'
      data:
        action: if @state.hasFavourited then 'unfavourite' else 'favourite'

    .done (data) =>
      @setState
        favcount: data.favourite_count
        hasFavourited: !@state.hasFavourited

    .fail (xhr, status) =>
      if status == 'abort'
        return

      osu.ajaxError xhr

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
        el Header,
          beatmapset: @props.beatmapset
          beatmaps: @state.beatmaps
          currentBeatmap: @state.currentBeatmap
          hoveredBeatmap: @state.hoveredBeatmap
          favcount: @state.favcount
          hasFavourited: @state.hasFavourited

        el Info,
          beatmapset: @props.beatmapset
          beatmap: @state.currentBeatmap

      div className: 'osu-layout__section osu-layout__section--extra',
        if @props.beatmapset.can_be_hyped
          div className: 'osu-page osu-page--generic-compact',
            el Hype,
              beatmapset: @props.beatmapset
              currentUser: currentUser

        if @props.beatmapset.is_scoreable
          div className: 'osu-page osu-page--generic',
            el Scoreboard,
              type: @state.currentScoreboardType
              beatmap: @state.currentBeatmap
              scores: @state.scores
              userScore: @state.userScore?.score
              userScorePosition: @state.userScore?.position
              enabledMods: @state.enabledMods
              countries: @props.countries
              loading: @state.loading
              isScoreable: @props.beatmapset.is_scoreable

        div className: 'osu-page osu-page--generic-compact',
          el CommentsManager,
            component: Comments
            commentableType: 'beatmapset'
            commentableId: @props.beatmapset.id


  saveStateToContainer: =>
    @props.container.dataset.state = JSON.stringify(@state)


  setHash: =>
    osu.setHash BeatmapsetPageHash.generate
      beatmap: @state.currentBeatmap
