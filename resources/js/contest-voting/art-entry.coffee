# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import UserLink from 'components/user-link'
import * as React from 'react'
import { div, span, a, i } from 'react-dom-factories'
import { classWithModifiers, urlPresence } from 'utils/css'
import { formatNumber } from 'utils/html'
import { transChoice } from 'utils/lang'
import { Voter } from './voter'

el = React.createElement
bn = 'contest-art-entry'

export class ArtEntry extends React.Component
  render: ->
    isSelected = @props.isSelected

    votingOver = moment(@props.contest.voting_ends_at).diff() <= 0
    showVotes = @props.contest.show_votes
    showName = @props.contest.show_names
    showUserLink = @props.entry.user?.id?
    thumbnailShape = @props.contest.thumbnail_shape
    galleryId = "contest-#{@props.contest.id}"
    buttonId = "#{galleryId}:#{@props.displayIndex}"
    hideVoteButton = (@props.selected.length >= @props.contest.max_votes || votingOver) && !isSelected

    if showVotes
      place = @props.displayIndex + 1
      top3 = place <= 3
      usersVotedPercentage = _.round((@props.entry.results.votes / @props.contest.users_voted_count)*100, 2)

    entryLinkProps =
      className: "#{bn}__thumbnail-link"
      href: @props.entry.preview

    if @props.contest.type == 'art'
      entryLinkProps.className += ' js-gallery'
      entryLinkProps['data-width'] = @props.entry.artMeta.width
      entryLinkProps['data-height'] = @props.entry.artMeta.height
      entryLinkProps['data-gallery-id'] = galleryId
      entryLinkProps['data-index'] = @props.displayIndex
      entryLinkProps['data-button-id'] = buttonId
    else
      entryLinkProps.rel = 'nofollow noreferrer'
      entryLinkProps.target = '_blank'

    div
      className: classWithModifiers bn,
        "#{thumbnailShape}": thumbnailShape?
        result: showVotes
        selected: isSelected
        'show-name': showName && !showVotes
        placed: showVotes && top3
        "placed-#{place}": showVotes && top3
        smaller: showVotes && !top3
      div
        className: "#{bn}__thumbnail",
        style:
          backgroundImage: urlPresence(@props.entry.thumbnail)
        a entryLinkProps

        div
          className: "#{bn}__vote-link-banner #{if hideVoteButton then 'hidden' else ''}"
          el Voter,
            key: @props.entry.id,
            entry: @props.entry,
            waitingForResponse: @props.waitingForResponse,
            voteCount: @props.selected.length,
            contest: @props.contest,
            selected: @props.selected,
            theme: 'art'
            buttonId: buttonId

      if showName || showVotes || showUserLink
        div className: "#{bn}__result",
          if showName
            a
              href: @props.entry.preview
              rel: 'nofollow noreferrer'
              target: '_blank'

              @props.entry.title

          if showUserLink && !showVotes
            div null, @renderUserLink()

          if showVotes
            el React.Fragment, null,
              div className: "#{bn}__result-ranking",
                div className: "#{bn}__result-place",
                  if top3
                    i className: "fas fa-fw fa-trophy #{bn}__trophy"
                  span {}, "##{place}"
                if showUserLink
                  @renderUserLink()
                else
                  span className: "#{bn}__entrant", @props.entry.results.actual_name

              div className: "#{bn}__result-pane",
                span className: "#{bn}__result-votes",
                  transChoice 'contest.vote.count', @props.entry.results.votes
                if Number.isFinite usersVotedPercentage
                  span className: "#{bn}__result-votes #{bn}__result-votes--percentage",
                    " (#{formatNumber(usersVotedPercentage)}%)"


  renderUserLink: ->
    el UserLink,
      className: "#{bn}__entrant"
      user: @props.entry.user
