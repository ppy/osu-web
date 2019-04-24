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

import { BaseEntryList } from './base-entry-list'
import { Entry } from './entry'
import { VoteSummary } from './vote-summary'
import * as React from 'react'
import { div,a,i,span } from 'react-dom-factories'
el = React.createElement

export class EntryList extends BaseEntryList
  render: ->
    if @state.contest.best_of && @state.contest.entries.length == 0
      return div className: 'contest__voting-notice',
        if currentUser.id?
          osu.trans('contest.voting.best_of.none_played')
        else
          osu.trans('contest.voting.login_required')

    return null unless @state.contest.entries.length > 0

    if @state.contest.show_votes
      totalVotes = _.sumBy @state.contest.entries, (i) -> i.results.votes

    entries = @state.contest.entries.map (entry, index) =>
      el Entry,
        key: entry.id,
        rank: index + 1,
        entry: entry,
        waitingForResponse: @state.waitingForResponse,
        options: @state.options,
        contest: @state.contest,
        selected: @state.selected,
        winnerVotes: if @state.contest.show_votes then _.maxBy(@state.contest.entries, (i) -> i.results.votes).results.votes
        totalVotes: if @state.contest.show_votes then totalVotes

    div className: 'contest-voting-list__table',
      div className: 'contest-voting-list__header',
        if @state.options.showPreview
          div className: 'contest-voting-list__icon'
        if @state.options.showLink
          div className: 'contest-voting-list__icon'
        div className: 'contest-voting-list__header-wrapper',
          div className: 'contest-voting-list__header-title', osu.trans('contest.entry._')
          div className: 'contest-voting-list__header-votesummary',
            div className: 'contest__vote-summary-text', osu.trans('contest.vote.list')
            el VoteSummary, voteCount: @state.selected.length, maxVotes: @state.contest.max_votes
      div {}, entries
