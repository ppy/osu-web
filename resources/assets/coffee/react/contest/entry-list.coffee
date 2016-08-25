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

class Contest.EntryList extends Contest.BaseEntryList
  render: ->
    return null unless @state.entries.length > 0

    if @state.contest.show_votes
      totalVotes = _.sumBy @state.entries, (i) -> i.votes

    entries = @state.entries.map (entry) =>
      el Contest.Entry,
        key: entry.id,
        entry: entry,
        waitingForResponse: @state.waitingForResponse,
        voteCount: @state.voteCount,
        options: @state.options,
        contest: @state.contest,
        winnerVotes: if @state.contest.show_votes then @state.entries[0].votes else null
        totalVotes: if @state.contest.show_votes then totalVotes else null

    div className: 'contest',
      table className: 'tracklist__table tracklist__table--smaller',
        thead {},
            tr className: 'tracklist__row--header',
              if @state.options.showPreview
                th className: 'tracklist__col tracklist__col--preview', ''
              if @state.options.showDL
                th className: 'tracklist__col tracklist__col--dl',
              th className: 'tracklist__col tracklist__col--title', 'entry'
              th className: 'tracklist__col tracklist__col--vote', colSpan: (if @props.contest.show_votes then 2 else 1),
                el Contest.VoteSummary, voteCount: @state.voteCount, maxVotes: @state.options.maxVotes
                div className: 'contest__vote-summary-text', 'votes'
        tbody {}, entries
