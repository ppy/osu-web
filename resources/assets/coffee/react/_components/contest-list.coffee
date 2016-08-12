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

{div,a,i,span,table,thead,tbody,tr,th,td} = React.DOM
el = React.createElement

class @ContestVoter extends React.Component
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

class @ContestVoteSummary extends React.Component
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

class @ContestEntry extends React.Component
  render: ->
    tr className: "trackplayer__row#{if @props.track.selected then ' trackplayer__row--selected' else ''}",
      if @props.options.showPreview
        td {},
          el TrackPreview, track: @props.track
      if @props.options.showDL
        td className: 'trackplayer__dl trackplayer__dl--contest',
          a className: 'trackplayer__link trackplayer__link--contest-dl', href: '#', title: 'Download Beatmap Template',
            i className: 'fa fa-fw fa-cloud-download'
      td className:'trackplayer__title',
        "#{@props.track.title} "

      td className:'trackplayer__vote',
        el ContestVoter, key: @props.track.id, track: @props.track, waitingForResponse: @props.waitingForResponse, voteCount: @props.voteCount, maxVotes: @props.options.maxVotes, contest: @props.contest

class @ContestList extends React.Component
  constructor: (props) ->
    super props
    @state =
      waitingForResponse: false
      tracks: @props.tracks
      voteCount: _.filter(@props.tracks, _.iteratee({selected: true})).length
      contest: @props.contest
      options:
        showDL: @props.options.showDL ? false
        showPreview: @props.options.showPreview ? false
        maxVotes: @props.contest.max_votes ? 3

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
    $.subscribe 'trackplayer:vote:click.trackplayer', @handleVoteClick
    $.subscribe 'trackplayer:vote:done.trackplayer', @handleUpdate

  componentWillUnmount: ->
    $.unsubscribe '.trackplayer'

  render: ->
    return null unless @state.tracks.length > 0

    tracks = @state.tracks.map (track) =>
      el ContestEntry,
        key: track.id,
        track: track,
        playing: track.id == @state.currently_playing,
        waitingForResponse: @state.waitingForResponse,
        voteCount: @state.voteCount,
        options: @state.options,
        contest: @state.contest

    div className: 'trackplayer',
      table className: 'trackplayer__table trackplayer__table--smaller',
        thead {},
            tr className: 'trackplayer__row--header',
              if @state.options.showPreview
                th className: 'trackplayer__col trackplayer__col--preview', ''
              if @state.options.showDL
                th className: 'trackplayer__col trackplayer__col--dl',
              th className: 'trackplayer__col trackplayer__col--title', 'entry'
              th className: 'trackplayer__col trackplayer__col--vote',
                el ContestVoteSummary, voteCount: @state.voteCount, maxVotes: @state.options.maxVotes
                div className: 'trackplayer__float-right trackplayer__vote-text', 'votes'
        tbody {}, tracks
