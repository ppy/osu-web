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
{a,i,tr,td,span} = React.DOM
el = React.createElement

class Contest.Entry extends React.Component
  render: ->
    votePercentage = _.round((@props.entry.votes / @props.contest.total_votes)*100, 2)
    relativeVotePercentage = _.round((@props.entry.votes / @props.contest.winner_votes)*100, 2)

    tr className: "tracklist__row#{if @props.entry.selected && !@props.contest.show_votes then ' tracklist__row--selected' else ''}",
      if @props.options.showPreview
        td {},
          el TrackPreview, track: @props.entry
      if @props.options.showDL
        td className: 'tracklist__dl tracklist__dl--contest',
          a className: 'tracklist__link tracklist__link--contest-dl', href: '#', title: 'Download Beatmap Template',
            i className: 'fa fa-fw fa-cloud-download'
      if @props.entry.actual_name
        td className: "tracklist__title#{if @props.contest.show_votes then ' tracklist__row--show-votes' else ''}", style: { backgroundSize: "#{relativeVotePercentage}%, 100%" },
          "#{@props.entry.title} "
          span className: 'tracklist__version', "#{@props.entry.actual_name}"
      else
        td className: 'tracklist__title', @props.entry.title

      td className: "contest__vote-star#{if @props.contest.show_votes then ' contest__vote-star--fixed' else ''}",
        el Contest.Voter, key: @props.entry.id, entry: @props.entry, waitingForResponse: @props.waitingForResponse, voteCount: @props.voteCount, maxVotes: @props.options.maxVotes, contest: @props.contest

      if @props.contest.show_votes
        td className:'contest__vote-count', "#{@props.entry.votes} votes (#{votePercentage}%)"
