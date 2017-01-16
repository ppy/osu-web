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
{a,i,div} = React.DOM
el = React.createElement

class Contest.Voting.Entry extends React.Component
  render: ->
    if @props.contest.show_votes
      votePercentage = _.round((@props.entry.results.votes / @props.totalVotes)*100, 2)
      relativeVotePercentage = _.round((@props.entry.results.votes / @props.winnerVotes)*100, 2)

    selected = _.includes @props.selected, @props.entry.id

    div className: "contest-voting-list__row#{if selected && !@props.contest.show_votes then ' contest-voting-list__row--selected' else ''}",
      if @props.options.showPreview
        div {},
          el TrackPreview, track: @props.entry
      if @props.options.showLink && @props.entry.preview
        div className: 'contest-voting-list__icon contest-voting-list__icon--bg',
          a className: 'tracklist__link', href: (if @props.contest.best_of then laroute.route('beatmapsets.show', beatmapset: @props.entry.preview) else @props.entry.preview),
            i className: "fa fa-fw fa-lg #{if @props.contest.link_icon then @props.contest.link_icon else 'fa-cloud-download'}"
      if @props.contest.show_votes
        div className: 'contest-voting-list__title contest-voting-list__title--show-votes', style: { backgroundSize: "#{relativeVotePercentage}%, 100%" },
          div className: 'contest-voting-list__title--inner u-ellipsis-overflow', "#{@props.entry.title} "
          div className: 'contest-voting-list__entrant', "#{@props.entry.results.username}"
      else
        div className: 'contest-voting-list__title u-ellipsis-overflow', @props.entry.title

      div className: "contest__vote-star#{if @props.contest.show_votes then ' contest__vote-star--fixed' else ''}",
        el Contest.Voting.Voter, key: @props.entry.id, entry: @props.entry, waitingForResponse: @props.waitingForResponse, selected: @props.selected, contest: @props.contest

      if @props.contest.show_votes
        div className:'contest__vote-count',
          "#{@props.entry.results.votes} votes"
          if not isNaN(votePercentage)
            " (#{votePercentage}%)"
