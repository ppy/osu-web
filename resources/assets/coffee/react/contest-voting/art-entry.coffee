# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Voter } from './voter'
import * as React from 'react'
import { div, span, a, i } from 'react-dom-factories'
import { classWithModifiers } from 'utils/css'

el = React.createElement

export class ArtEntry extends React.Component
  render: ->
    bn = 'contest-art-entry'
    isSelected = _.includes @props.selected, @props.entry.id

    return null if @props.hideIfNotVoted && !isSelected

    votingOver = moment(@props.contest.voting_ends_at).diff() <= 0
    showVotes = @props.contest.show_votes
    showNames = @props.contest.show_names
    thumbnailShape = @props.contest.thumbnail_shape
    galleryId = "contest-#{@props.contest.id}"
    buttonId = "#{galleryId}:#{@props.displayIndex}"
    hideVoteButton = (@props.selected.length >= @props.contest.max_votes || votingOver) && !isSelected

    if showVotes
      votePercentage = _.round((@props.entry.results.votes / @props.totalVotes)*100, 2)
      place = @props.displayIndex + 1
      top3 = place <= 3

    linkClasses = "#{bn}__thumbnail"
    linkClasses += " #{bn}--selected" if isSelected
    linkClasses += ' js-gallery' if @props.contest.type == 'art'

    entryLink =
      if @props.contest.type == 'art'
        a
          className: linkClasses
          href: @props.entry.preview
          'data-width': @props.entry.artMeta.width
          'data-height': @props.entry.artMeta.height
          'data-gallery-id': galleryId
          'data-index': @props.displayIndex
          'data-button-id': buttonId
      else
        a
          className: linkClasses
          href: @props.entry.preview
          rel: 'nofollow noreferrer'
          target: '_blank'

    div
      style:
        backgroundImage: osu.urlPresence(@props.entry.thumbnail)
      className: classWithModifiers bn,
        "#{thumbnailShape}": thumbnailShape?
        result: showVotes
        'show-name': showNames && !showVotes
        placed: showVotes && top3
        "placed-#{place}": showVotes && top3
        smaller: showVotes && !top3
      entryLink

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

      if showNames
        div className: "#{bn}__result",
          a
            href: @props.entry.preview
            rel: 'nofollow noreferrer'
            target: '_blank'

            @props.entry.title

      if showVotes
        div className: "#{bn}__result",
          div className: "#{bn}__result-ranking",
            div className: "#{bn}__result-place",
              if top3
                i className: "fas fa-fw fa-trophy #{bn}__trophy--#{place}"
              span {}, "##{place}"
            if @props.entry.results.user_id
              a
                className: "#{bn}__entrant js-usercard",
                'data-user-id': @props.entry.results.user_id,
                href: laroute.route('users.show', user: @props.entry.results.user_id),
                  @props.entry.results.username
            else
              span className: "#{bn}__entrant', @props.entry.results.actual_name"
          div className: "#{bn}__result-pane",
            span className: "#{bn}__result-votes",
              osu.transChoice 'contest.vote.count', @props.entry.results.votes
            if not isNaN(votePercentage)
              span className: "#{bn}__result-votes #{bn}__result-votes--percentage",
                " (#{osu.formatNumber(votePercentage)}%)"
