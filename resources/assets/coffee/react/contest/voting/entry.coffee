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
{a,i,tr,td,span,div} = React.DOM
el = React.createElement

class Contest.Voting.Entry extends React.Component
  render: ->
    if @props.contest.show_votes
      votePercentage = _.round((@props.entry.results.votes / @props.totalVotes)*100, 2)
      relativeVotePercentage = _.round((@props.entry.results.votes / @props.winnerVotes)*100, 2)

    selected = _.includes @props.selected, @props.entry.id

    tr className: "tracklist__row#{if selected && !@props.contest.show_votes then ' tracklist__row--selected' else ''}",
      if @props.options.showPreview
        td {},
          el TrackPreview, track: @props.entry
      if @props.contest.show_votes
        td className: "tracklist__title tracklist__row--show-votes", style: { backgroundSize: "#{relativeVotePercentage}%, 100%" },
          div {}, "#{@props.entry.title} "
          div className: 'tracklist__version', "#{@props.entry.results.actual_name}"
      else
        td className: 'tracklist__title', @props.entry.title

      td className: "contest__vote-star#{if @props.contest.show_votes then ' contest__vote-star--fixed' else ''}",
        el Contest.Voting.Voter, key: @props.entry.id, entry: @props.entry, waitingForResponse: @props.waitingForResponse, selected: @props.selected, contest: @props.contest

      if @props.contest.show_votes
        td className:'contest__vote-count',
          "#{@props.entry.results.votes} votes"
          if not isNaN(votePercentage)
            " (#{votePercentage}%)"
