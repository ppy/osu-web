###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

{div,a,i} = ReactDOMFactories
el = React.createElement

class Contest.Voting.Voter extends React.Component
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

    classes = [
      'contest__voting-star',
      'contest__voting-star--float-right',
      if @props.theme then "contest__voting-star--#{@props.theme}",
    ]

    if (@props.selected.length >= @props.contest.max_votes || votingOver) && !@isSelected()
      div className: classes.join(' '), null
    else
      if @isSelected()
        selected_class =  [
          if @props.theme then "contest__voting-star--selected-#{@props.theme}" else 'contest__voting-star--selected'
        ]
      else
        selected_class = []

      if votingOver
        div className: classes.concat(selected_class).join(' '),
          i className: "fas fa-fw fa-star"
      else
        if @props.waitingForResponse && !@isSelected()
          div className: classes.join(' '),
            i className: "fas fa-fw fa-sync contest__voting-star--spin"
        else
          a className: classes.concat(selected_class).join(' '), href: '#', onClick: @handleClick,
            i className: "fas fa-fw fa-star"
