###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

import { ArtEntry } from './art-entry'
import { BaseEntryList } from './base-entry-list'
import { VoteSummary } from './vote-summary'
import * as React from 'react'
import { div, span } from 'react-dom-factories'
el = React.createElement

export class ArtEntryList extends BaseEntryList
  render: ->
    return null unless @state.contest.entries.length > 0

    if @state.contest.show_votes
      totalVotes = _.sumBy @state.contest.entries, (i) -> i.results.votes

    entries = @state.contest.entries.map (entry, index) =>
      el ArtEntry,
        key: index,
        displayIndex: index,
        entry: entry,
        waitingForResponse: @state.waitingForResponse,
        options: @state.options,
        contest: @state.contest,
        selected: @state.selected,
        totalVotes: if @state.contest.show_votes then totalVotes

    if @state.contest.show_votes
      partitions = _.partition entries, (i) ->
        i.props.displayIndex < 3

    div className: 'contest__art-list',
      div className: 'contest__vote-summary--art',
        span className: 'contest__vote-summary-text contest__vote-summary-text--art', 'votes'
        el VoteSummary, voteCount: @state.selected.length, maxVotes: @state.contest.max_votes

      if @state.contest.show_votes
        div {},
          div className: 'contest-art-list contest-art-list--top3', partitions[0]
          div className: 'contest-art-list', partitions[1]
      else
        div className: 'contest-art-list', entries
