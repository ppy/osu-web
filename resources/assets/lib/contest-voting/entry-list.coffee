# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { BaseEntryList } from './base-entry-list'
import { Entry } from './entry'
import { VoteSummary } from './vote-summary'
import * as React from 'react'
import { div,a,i,span } from 'react-dom-factories'
import { classWithModifiers } from 'utils/css'
import { trans } from 'utils/lang'
el = React.createElement

export class EntryList extends BaseEntryList
  render: ->
    if @state.contest.best_of && @state.contest.entries.length == 0
      return div className: 'contest__voting-notice',
        if currentUser.id?
          trans('contest.voting.best_of.none_played')
        else
          trans('contest.voting.login_required')

    return null unless @state.contest.entries.length > 0

    entries = @state.contest.entries.map (entry, index) =>
      el Entry,
        key: entry.id,
        rank: index + 1,
        entry: entry,
        hideIfNotVoted: @state.showVotedOnly
        waitingForResponse: @state.waitingForResponse,
        options: @state.options,
        contest: @state.contest,
        selected: @state.selected,
        winnerVotes: if @state.contest.show_votes then _.maxBy(@state.contest.entries, (i) -> i.results.votes).results.votes

    div className: 'contest-voting-list__table',
      div className: 'contest-voting-list__header',
        if @state.contest.show_votes
          div className: 'contest-voting-list__rank contest-voting-list__rank--blank'
        if @state.options.showPreview
          div className: 'contest-voting-list__icon'
        if @state.options.showLink
          div className: classWithModifiers('contest-voting-list__icon', 'submitted-beatmaps': @state.contest.submitted_beatmaps)
        div className: 'contest-voting-list__header-wrapper',
          div className: 'contest-voting-list__header-title', trans('contest.entry._')
          div className: 'contest-voting-list__header-voted-toggle-button',
            @renderToggleShowVotedOnly()
          div className: 'contest-voting-list__header-votesummary',
            div className: 'contest__vote-summary-text', trans('contest.vote.list')
            el VoteSummary, voteCount: @state.selected.length, maxVotes: @state.contest.max_votes
      div {}, entries
