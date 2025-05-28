# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import TrackPreview from 'components/track-preview'
import UserLink from 'components/user-link'
import { includes, round } from 'lodash'
import { route } from 'laroute'
import * as React from 'react'
import { a, i, div, span } from 'react-dom-factories'
import { formatNumber } from 'utils/html'
import { trans, transChoice } from 'utils/lang'
import { Voter } from './voter'

el = React.createElement

export class Entry extends React.Component
  render: ->
    selected = includes @props.selected, @props.entry.id

    return null if @props.hideIfNotVoted && !selected

    link_icon = if @props.contest.type == 'external' then 'fa-external-link-alt' else 'fa-download'

    if @props.contest.show_votes
      relativeVotePercentage = if @props.stdRange.min? && @props.stdRange.max?
        100 * (@props.entry.results.score_std - @props.stdRange.min) / (@props.stdRange.max - @props.stdRange.min)
      else
        round((@props.entry.results.votes / @props.winnerVotes)*100, 2)

      usersVotedPercentage = round((@props.entry.results.votes / @props.contest.users_voted_count)*100, 2)

    div className: "contest-voting-list__row#{if selected && !@props.contest.show_votes then ' contest-voting-list__row--selected' else ''}",
      if @props.contest.show_votes
        div className: 'contest-voting-list__rank',
          if @props.rank < 4
            span className: "contest-voting-list__trophy contest-voting-list__trophy--#{@props.rank}",
              i className: 'fas fa-fw fa-trophy'
          else
            "##{@props.rank}"
      if @props.options.showPreview
        div className: 'contest-voting-list__preview',
          el TrackPreview, track: @props.entry
      if @props.options.showLink && @props.entry.preview
        if @props.contest.submitted_beatmaps
          a href: route('beatmapsets.show', beatmapset: @props.entry.preview), className: 'contest-voting-list__icon contest-voting-list__icon--submitted-beatmaps', style: { background: "url(https://b.ppy.sh/thumb/#{@props.entry.preview}.jpg)" },
            span className: 'contest-voting-list__link contest-voting-list__link--shadowed',
              i className: "fas fa-fw fa-lg fa-#{@props.contest.link_icon}"
        else
          div className: 'contest-voting-list__icon contest-voting-list__icon--bg',
            a
              className: 'contest-voting-list__link'
              href: @props.entry.preview
              rel: 'nofollow noreferrer'
              target: '_blank'
              i className: "fas fa-fw fa-lg #{link_icon}"
      if @props.contest.show_votes
        div className: 'contest-voting-list__title contest-voting-list__title--show-votes',
          div className: 'contest-voting-list__votes-bar', style: { width: "#{relativeVotePercentage}%" }
          @renderTitle()
      else
        div className: 'contest-voting-list__title', @renderTitle()

      if !@props.contest.judged
        div className: "contest__voting-star#{if @props.contest.show_votes then ' contest__voting-star--dark-bg' else ''}",
          el Voter, key: @props.entry.id, entry: @props.entry, waitingForResponse: @props.waitingForResponse, selected: @props.selected, contest: @props.contest

      if @props.contest.show_votes
        @renderScore()

      if @props.contest.judged
        div className: 'contest-voting-list__icon contest-voting-list__icon--bg',
          a
            className: 'contest-voting-list__link'
            href: route('contest-entries.judge-results', @props.entry.id)
            target: '_blank'
            i className: 'fas fa-fw fa-lg fa-external-link-alt'


  renderScore: ->
    if @props.contest.best_of || @props.contest.judged
      text = if @props.entry.results.score_std?
        trans 'contest.vote.points_float', points: formatNumber(@props.entry.results.score_std, 2)
      else
        transChoice 'contest.vote.points', @props.entry.results.votes

      div className: 'contest__vote-count contest__vote-count--no-percentages',
        text
    else
      div className: 'contest__vote-count',
        transChoice 'contest.vote.count', @props.entry.results.votes
        if Number.isFinite usersVotedPercentage
          " (#{formatNumber(usersVotedPercentage)}%)"


  renderTitle: ->
    el React.Fragment, null,
      if @props.contest.type == 'external'
        a
          className: 'contest-voting-list__title-link u-ellipsis-overflow u-relative'
          rel: 'nofollow noreferrer'
          target: '_blank'
          href: @props.entry.preview,
          @props.entry.title
      else if @props.options.showLink && @props.entry.preview && @props.contest.submitted_beatmaps
        a
          className: 'contest-voting-list__title-link u-ellipsis-overflow u-relative',
          href: route('beatmapsets.show', beatmapset: @props.entry.preview)
          @props.entry.title
      else
        div className: 'u-relative u-ellipsis-overflow', @props.entry.title
      @renderUserLink()

  renderUserLink: ->
    return null unless @props.entry.user?.id?

    el UserLink,
      user: @props.entry.user
      className: 'contest-voting-list__entrant'
