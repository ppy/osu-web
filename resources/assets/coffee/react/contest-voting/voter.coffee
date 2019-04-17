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

import * as React from 'react'
import { div,a,i } from 'react-dom-factories'
el = React.createElement

export class Voter extends React.Component
  constructor: (props) ->
    super props

  sendVote: =>
    params =
      method: 'PUT'
      dataType: 'json'

    $.ajax laroute.route('contest-entries.vote', contest_entry: @props.entry.id), params

    .done (response) =>
      $.publish 'contest:vote:done', response: response

    .fail osu.ajaxError

    .always =>
      $.publish 'contest:vote:end'

  handleClick: (e) =>
    e.preventDefault()
    return unless @isSelected() || @props.selected.length < @props.contest.max_votes

    if !currentUser.id?
      userLogin.show e.target
    else if !@props.waitingForResponse
      $.publish 'contest:vote:click', contest_id: @props.contest.id, entry_id: @props.entry.id
      @sendVote()

  isSelected: =>
    _.includes @props.selected, @props.entry.id

  render: ->
    votingOver = moment(@props.contest.voting_ends_at).diff() <= 0
    isSelected = @isSelected()
    isLoading = @props.waitingForResponse
    hasVote = @props.selected.length < @props.contest.max_votes
    isVisible = isSelected || (!votingOver && hasVote)

    classes = [
      'js-contest-vote-button'
      'contest__voting-star',
      'contest__voting-star--float-right',
      if @props.theme then "contest__voting-star--#{@props.theme}",
    ]

    component = div
    props =
      'data-button-id': @props.buttonId
      'data-contest-vote-meta': JSON.stringify({hasVote, isSelected, isLoading, votingOver})
    icon = null

    if !isVisible
      props.className = classes.join(' ')
    else
      if isSelected
        selected_class =  [
          if @props.theme then "contest__voting-star--selected-#{@props.theme}" else 'contest__voting-star--selected'
        ]
      else
        selected_class = []

      if votingOver
        props.className = classes.concat(selected_class).join(' ')
        icon = i className: 'fas fa-fw fa-star'
      else
        if isLoading && !isSelected
          props.className = classes.join(' ')
          icon = i className: 'fas fa-fw fa-sync contest__voting-star--spin'
        else
          component = a
          props.className = classes.concat(selected_class).join(' ')
          props.href = '#'
          props.onClick = @handleClick
          icon = i className: 'fas fa-fw fa-star'

    component props, icon
