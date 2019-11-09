###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import { Voter } from './voter'
import * as React from 'react'
import { div, span, a, i } from 'react-dom-factories'
el = React.createElement

export class ArtEntry extends React.Component
  render: ->
    votingOver = moment(@props.contest.voting_ends_at).diff() <= 0
    isSelected = _.includes @props.selected, @props.entry.id
    showVotes = @props.contest.show_votes
    shape = @props.contest.shape
    galleryId = "contest-#{@props.contest.id}"
    buttonId = "#{galleryId}:#{@props.displayIndex}"
    hideVoteButton = (@props.selected.length >= @props.contest.max_votes || votingOver) && !isSelected

    if showVotes
      votePercentage = _.round((@props.entry.results.votes / @props.totalVotes)*100, 2)
      place = @props.displayIndex + 1
      top3 = place <= 3

    divClasses = [
      'contest-art-entry',
      'contest-art-entry--result' if showVotes,
      "contest-art-entry--placed contest-art-entry--placed-#{place}" if showVotes && top3,
      'contest-art-entry--smaller' if showVotes && !top3,
      "contest-art-entry--#{shape}" if shape
    ]

    div style: { backgroundImage: osu.urlPresence(@props.entry.artMeta.thumb) }, className: _.compact(divClasses).join(' '),
      a {
        className: _.compact([
          'js-gallery contest-art-entry__thumbnail',
          'contest-art-entry--selected' if isSelected,
        ]).join(' '),
        href: @props.entry.preview,
        'data-width': @props.entry.artMeta.width,
        'data-height': @props.entry.artMeta.height,
        'data-gallery-id': galleryId,
        'data-index': @props.displayIndex,
        'data-button-id': buttonId
      }

      div
        className: _([
          'contest__vote-link-banner'
          'contest__vote-link-banner--selected' if isSelected
          'contest__vote-link-banner--smaller' if showVotes && place > 2
          'hidden' if hideVoteButton
        ]).compact().join(' ')
        el Voter,
          key: @props.entry.id,
          entry: @props.entry,
          waitingForResponse: @props.waitingForResponse,
          voteCount: @props.selected.length,
          contest: @props.contest,
          selected: @props.selected,
          theme: if showVotes && place > 2 then 'art-smaller' else 'art'
          buttonId: buttonId

      if showVotes
        div className: 'contest-art-entry__result',
          div className: 'contest-art-entry__result-ranking',
            div className: 'contest-art-entry__result-place',
              if top3
                i className: "fas fa-fw fa-trophy contest-art-entry__trophy--#{place}"
              span {}, "##{place}"
            if @props.entry.results.user_id
              a
                className: 'contest-art-entry__entrant js-usercard',
                'data-user-id': @props.entry.results.user_id,
                href: laroute.route('users.show', user: @props.entry.results.user_id),
                  @props.entry.results.username
            else
              span className: 'contest-art-entry__entrant', @props.entry.results.actual_name
          div className: 'contest-art-entry__result-pane',
            span className: 'contest-art-entry__result-votes',
              osu.transChoice 'contest.vote.count', @props.entry.results.votes
            if not isNaN(votePercentage)
              span className: 'contest-art-entry__result-votes contest-art-entry__result-votes--percentage',
                " (#{osu.formatNumber(votePercentage)}%)"
