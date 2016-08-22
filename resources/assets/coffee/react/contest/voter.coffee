###*
*    Copyright 2015 ppy Pty. Ltd.
*
*    This file is part of osu!web. osu!web is distributed with the hope of
*    attracting more community contributions to the core ecosystem of osu!.
*
*    osu!web is free software: you can redistribute it and/or modify
*    it under the terms of the Affero GNU General Public License version 3
*    as published by the Free Software Foundation.
*
*    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
*    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*    See the GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
*
###
{div,a,i} = React.DOM
el = React.createElement

class Contest.Voter extends React.Component
  constructor: (props) ->
    super props

  sendVote: =>
    # in case called from loginSuccess or other possible show loading overlay thing.
    LoadingOverlay.hide()

    params =
      method: 'PUT'
      data:
        entry_id: @props.track.id

    $.ajax laroute.route("contest.vote", contest_id: @props.contest.id), params

    .done (response) =>
      $.publish 'contest:vote:done', tracks: response.tracks

    .fail osu.ajaxError

  handleClick: (e) =>
    e.preventDefault()
    return unless @props.track.selected || @props.voteCount < @props.maxVotes

    if !currentUser.id?
      userLogin.show e.target
    else if !@props.waitingForResponse
      $.publish 'contest:vote:click', track_id: @props.track.id
      @sendVote()

  render: ->
    votingOver = moment(@props.contest.ends_at).diff() <= 0

    if (@props.voteCount >= @props.maxVotes || votingOver) && !@props.track.selected
      null
    else
      classes = [
        'trackplayer__float-right',
        'trackplayer__voting-star',
        if @props.theme then "trackplayer__voting-star--#{@props.theme}",
      ]

      if @props.track.selected
        selected_class =  [
          if @props.theme then "trackplayer__voting-star--selected-#{@props.theme}" else 'trackplayer__voting-star--selected'
        ]
      else
        selected_class = []

      if votingOver
        div className: classes.concat(selected_class).join(' '),
          i className: "fa fa-fw fa-star"
      else
        if @props.waitingForResponse && !@props.track.selected
          div className: classes.join(' '),
            i className: "fa fa-fw fa-refresh trackplayer__voting-star--spin"
        else
          a className: classes.concat(selected_class).join(' '), href: '#', onClick: @handleClick,
            i className: "fa fa-fw fa-star"
