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

class Contest.ArtList extends React.Component
  constructor: (props) ->
    super props
    @state =
      waitingForResponse: false
      entries: @props.tracks
      voteCount: _.filter(@props.tracks, _.iteratee({selected: true})).length
      contest: @props.contest
      options:
        maxVotes: @props.contest.max_votes ? 3

  handleVoteClick: (_e, {track_id, callback}) =>
    entries = @state.entries
    entry = _.findIndex(@state.entries, { id: track_id });
    entries[entry].selected = !entries[entry].selected
    @setState
      entries: entries
      waitingForResponse: true
      voteCount: _.filter(entries, _.iteratee({selected: true})).length
      callback

  handleUpdate: (_e, {tracks, callback}) =>
    @setState
      entries: tracks
      waitingForResponse: false
      voteCount: _.filter(tracks, _.iteratee({selected: true})).length
      callback

  componentDidMount: ->
    $.subscribe 'contest:vote:click.contest', @handleVoteClick
    $.subscribe 'contest:vote:done.contest', @handleUpdate

  componentWillUnmount: ->
    $.unsubscribe '.contest'

  render: ->
    return null unless @state.entries.length > 0

    entries = @state.entries.map (entry) =>
      el Contest.ArtEntry,
        key: entry.id,
        entry: entry,
        waitingForResponse: @state.waitingForResponse,
        voteCount: @state.voteCount,
        options: @state.options,
        contest: @state.contest

    div className: 'trackplayer',
      div className: 'trackplayer__vote-summary--art',
        span className: 'trackplayer__vote-summary-text trackplayer__vote-summary-text--art', 'votes'
        el Contest.VoteSummary, voteCount: @state.voteCount, maxVotes: @state.options.maxVotes
      div style: { display: 'flex', alignItems: 'flex-start', flexWrap: 'wrap', justifyContent: 'space-around' }, entries
