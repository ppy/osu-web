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

class Contest.EntryList extends React.Component
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
    $.subscribe 'contest:vote:click.contest', @handleVoteClick
    $.subscribe 'contest:vote:done.contest', @handleUpdate

  componentWillUnmount: ->
    $.unsubscribe '.contest'

  render: ->
    return null unless @state.tracks.length > 0

    tracks = @state.tracks.map (track) =>
      el Contest.Entry,
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
                el Contest.VoteSummary, voteCount: @state.voteCount, maxVotes: @state.options.maxVotes
                div className: 'trackplayer__float-right trackplayer__vote-text', 'votes'
        tbody {}, tracks
