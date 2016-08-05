###*
*    Copyright 2015 ppy Pty. Ltd.
*
*    This file is part of osu!web. osu!web is distributed with the hope of
*    attracting more community contributions to the core ecosystem of osu!.
*
*    osu!web is free software: you can redistribute it and/or modify
*    it under the terms of the Affero GNU General Public License version 3
*    as published by the Free Software Foundation.
*
*    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
*    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*    See the GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
*
###

{div,a,i,span,table,thead,tbody,tr,th,td,audio} = React.DOM
el = React.createElement

class @TrackVoter extends React.Component
  constructor: (props) ->
    super props

  sendVote: =>
    # in case called from loginSuccess or other possible show loading overlay thing.
    LoadingOverlay.hide()

    params =
      method: 'PUT'
      data:
        entry_id: @props.track.id

    $.ajax laroute.route("contest.vote", contest_id: @props.contest.id), params

    .done (response) =>
      $.publish 'trackplayer:vote:done', tracks: response.tracks

    .fail osu.ajaxError

  handleClick: (e) =>
    e.preventDefault()
    return unless @props.track.selected || @props.voteCount < @props.maxVotes

    if !currentUser.id?
      userLogin.show e.target
    else if !@props.waitingForResponse
      $.publish 'trackplayer:vote:click', track_id: @props.track.id
      @sendVote()

  render: ->
    if @props.voteCount >= @props.maxVotes && !@props.track.selected
      null
    else
      if @props.waitingForResponse && !@props.track.selected
        div className: "trackplayer__float-right trackplayer__voting-star#{if @props.track.selected then ' trackplayer__voting-star--selected' else ''}", href: '#', onClick: @handleClick,
          i className: "fa fa-fw fa-refresh"
      else
        a className: "trackplayer__float-right trackplayer__voting-star#{if @props.track.selected then ' trackplayer__voting-star--selected' else ''}", href: '#', onClick: @handleClick,
          i className: "fa fa-fw fa-star"

class @TrackVoteSummary extends React.Component
  render: ->
    voteSummary = []
    voteSummary.push _.times Math.max(0, @props.maxVotes - @props.voteCount), ->
      div className: "trackplayer__float-right trackplayer__voting-star trackplayer__voting-star--smaller",
        i className: "fa fa-fw fa-star"
    voteSummary.push _.times @props.voteCount, ->
      div className: "trackplayer__float-right trackplayer__voting-star trackplayer__voting-star--smaller trackplayer__voting-star--selected",
        i className: "fa fa-fw fa-star"

    div {},
      voteSummary

class @Track extends React.Component
  playPreview: (e) =>
    e.preventDefault()
    $.publish 'trackplayer:preview', id: @props.track.id

  playDone: (e) =>
    $.publish 'trackplayer:previewDone', id: @props.track.id

  render: ->
    tr className: "trackplayer__row#{if @props.track.selected then ' trackplayer__row--selected' else ''}",
      td className: 'trackplayer__cover', style: { backgroundImage: "url('#{@props.track.cover_url}')" },
        a className: 'trackplayer__preview', href: '#', onClick: @playPreview,
          i className: "fa fa-fw #{if @props.playing then 'fa-pause' else 'fa-play'}"
        audio id: "track-#{@props.track.id}-audio", src: (if @props.playing then @props.track.preview else ''), preload: 'none', onEnded: @playDone
      td className:'trackplayer__title',
        "#{@props.track.title} "
        span className: 'trackplayer__version', @props.track.version
      unless @props.options.hideLength
        td className: 'trackplayer__length', @props.track.length
      unless @props.options.hideBPM
        td className: 'trackplayer__bpm', "#{@props.track.bpm}bpm"
      unless @props.options.hideGenre
        td className: 'trackplayer__genre', @props.track.genre
      unless @props.options.hideDL
        td className: 'trackplayer__dl',
          if @props.track.osz
            a className: 'trackplayer__link', href: @props.track.osz, title: 'Download Beatmap Template',
              i className: 'fa fa-fw fa-cloud-download'
          else
            span className: 'trackplayer__link--disabled', title: 'Beatmap Template not yet available',
              i className: 'fa fa-fw fa-cloud-download'

      if @props.options.showVote
        td className:'trackplayer__vote',
          el TrackVoter, key: @props.track.id, track: @props.track, waitingForResponse: @props.waitingForResponse, voteCount: @props.voteCount, maxVotes: @props.options.maxVotes, contest: @props.contest

class @Trackplayer extends React.Component
  constructor: (props) ->
    super props
    @state =
      waitingForResponse: false
      currently_playing: null
      tracks: @props.tracks
      voteCount: _.filter(@props.tracks, _.iteratee({selected: true})).length
      contest: @props.contest
      options:
        hideLength: @props.options.hideLength ? false
        hideBPM: @props.options.hideBPM ? false
        hideGenre: @props.options.hideGenre ? false
        hideDL: @props.options.hideDL ? false
        showVote: @props.options.showVote ? false
        smaller: @props.options.smaller ? false
        maxVotes: @props.options.maxVotes ? 3

  stopTrack: (id) ->
    $("#track-#{id}-audio")[0].pause()

  playTrack: (id) ->
    ele = $("#track-#{id}-audio")[0]
    ele.load()
    ele.currentTime = 0
    ele.play()

  handlePreviewDone: (_e, {id}) =>
    @setState currently_playing: null

  handlePreview: (_e, {id}) =>
    if @state.currently_playing != null
      @stopTrack @state.currently_playing
      if @state.currently_playing == id
        justPause = true
      @setState currently_playing: null

    if not justPause
      @setState currently_playing: id, ->
        @playTrack id

  handleVoteClick: (_e, {track_id, callback}) =>
    tracks = @state.tracks
    track = _.findIndex(@state.tracks, { id: track_id });
    tracks[track].selected = !tracks[track].selected
    @setState
      tracks: tracks
      waitingForResponse: true
      voteCount: _.filter(tracks, _.iteratee({selected: true})).length
      callback

  handleUpdate: (_e, {tracks, callback}) =>
    @setState
      tracks: tracks
      waitingForResponse: false
      voteCount: _.filter(tracks, _.iteratee({selected: true})).length
      callback

  componentDidMount: ->
    $.subscribe 'trackplayer:preview.trackplayer', @handlePreview
    $.subscribe 'trackplayer:previewDone.trackplayer', @handlePreviewDone
    $.subscribe 'trackplayer:vote:click.trackplayer', @handleVoteClick
    $.subscribe 'trackplayer:vote:done.trackplayer', @handleUpdate

  componentWillUnmount: ->
    $.unsubscribe '.trackplayer'

  render: ->
    return null unless @state.tracks.length > 0

    tracks = @state.tracks.map (track) =>
      el Track,
        key: track.id,
        track: track,
        playing: track.id == @state.currently_playing,
        waitingForResponse: @state.waitingForResponse,
        voteCount: @state.voteCount,
        options: @state.options,
        contest: @state.contest

    div className: 'trackplayer',
      table className: "trackplayer__table#{ if @state.options.smaller then ' trackplayer__table--smaller' else ''}",
        thead {},
            tr className: 'trackplayer__row--header',
                th className: 'trackplayer__col', ''
                th className: 'trackplayer__col trackplayer__col--title', 'title'
                unless @state.options.hideLength
                  th className: 'trackplayer__col', 'length'
                unless @state.options.hideBPM
                  th className: 'trackplayer__col', 'bpm'
                unless @state.options.hideGenre
                  th className: 'trackplayer__col', 'genre'
                unless @state.options.hideDL
                  th className: 'trackplayer__col trackplayer__col--dl',
                if @state.options.showVote
                  th className: 'trackplayer__col trackplayer__col--vote',
                    el TrackVoteSummary, voteCount: @state.voteCount, maxVotes: @state.options.maxVotes
                    div className: 'trackplayer__float-right trackplayer__vote-text', 'votes'
        tbody {}, tracks
