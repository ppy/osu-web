# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Voter } from './voter'
import * as React from 'react'
import { a,i,div,span } from 'react-dom-factories'
import TrackPreview from 'track-preview'
el = React.createElement

export class Entry extends React.Component
  render: ->
    selected = _.includes @props.selected, @props.entry.id

    return null if @props.hideIfNotVoted && !selected

    if @props.contest.type == 'external'
      link_icon = 'fa-external-link-alt'
      entry_title =
        a
          rel: 'nofollow noreferrer'
          target: '_blank'
          href: @props.entry.preview,
          @props.entry.title
    else
      link_icon = 'fa-download'
      entry_title = @props.entry.title

    if @props.contest.show_votes
      votePercentage = _.round((@props.entry.results.votes / @props.totalVotes)*100, 2)
      relativeVotePercentage = _.round((@props.entry.results.votes / @props.winnerVotes)*100, 2)

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
        if @props.contest.best_of
          a href: laroute.route('beatmapsets.show', beatmapset: @props.entry.preview), className: 'contest-voting-list__icon contest-voting-list__icon--best-of', style: { background: "url(https://b.ppy.sh/thumb/#{@props.entry.preview}.jpg)" },
            span className: 'tracklist__link tracklist__link--shadowed',
              i className: "fal fa-fw fa-lg fa-#{@props.contest.link_icon}"
        else
          div className: 'contest-voting-list__icon contest-voting-list__icon--bg',
            a className: 'tracklist__link', href: @props.entry.preview, rel: 'nofollow noreferrer', target: '_blank',
              i className: "fas fa-fw fa-lg #{link_icon}"
      if @props.contest.show_votes
        div className: 'contest-voting-list__title contest-voting-list__title--show-votes',
          div className: 'contest-voting-list__votes-bar', style: { width: "#{relativeVotePercentage}%" }
          div className: 'u-relative u-ellipsis-overflow', entry_title
          a
            className: 'contest-voting-list__entrant js-usercard',
            'data-user-id': @props.entry.results.user_id,
            href: laroute.route('users.show', user: @props.entry.results.user_id),
              @props.entry.results.username
      else
        div className: 'contest-voting-list__title u-ellipsis-overflow', entry_title

      div className: "contest__voting-star#{if @props.contest.show_votes then ' contest__voting-star--dark-bg' else ''}",
        el Voter, key: @props.entry.id, entry: @props.entry, waitingForResponse: @props.waitingForResponse, selected: @props.selected, contest: @props.contest

      if @props.contest.show_votes
        if @props.contest.best_of
          div className:'contest__vote-count contest__vote-count--no-percentages',
            osu.transChoice 'contest.vote.points', @props.entry.results.votes
        else
          div className:'contest__vote-count',
            osu.transChoice 'contest.vote.count', @props.entry.results.votes
            if isFinite(votePercentage)
              " (#{osu.formatNumber(votePercentage)}%)"
