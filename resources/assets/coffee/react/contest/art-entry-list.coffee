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

class Contest.ArtEntryList extends Contest.BaseEntryList
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

    div className: 'contest',
      div className: 'contest__vote-summary--art',
        span className: 'contest__vote-summary-text contest__vote-summary-text--art', 'votes'
        el Contest.VoteSummary, voteCount: @state.voteCount, maxVotes: @state.options.maxVotes
      div className: 'contest__entries--art', entries
