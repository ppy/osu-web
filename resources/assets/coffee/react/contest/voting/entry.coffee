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

{a,i,div,span} = ReactDOMFactories
el = React.createElement

class Contest.Voting.Entry extends React.Component
  render: ->
    if @props.contest.show_votes
      votePercentage = _.round((@props.entry.results.votes / @props.totalVotes)*100, 2)
      relativeVotePercentage = _.round((@props.entry.results.votes / @props.winnerVotes)*100, 2)

    selected = _.includes @props.selected, @props.entry.id

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
            a className: 'tracklist__link', href: @props.entry.preview,
              i className: 'fas fa-fw fa-lg fa-download'
      if @props.contest.show_votes
        div className: 'contest-voting-list__title contest-voting-list__title--show-votes',
          div className: 'contest-voting-list__votes-bar', style: { width: "#{relativeVotePercentage}%" }
          div className: 'u-ellipsis-overflow', @props.entry.title
          a
            className: 'contest-voting-list__entrant js-usercard',
            'data-user-id': @props.entry.results.user_id,
            href: laroute.route('users.show', user: @props.entry.results.user_id),
              @props.entry.results.username
      else
        div className: 'contest-voting-list__title u-ellipsis-overflow', @props.entry.title

      div className: "contest__voting-star#{if @props.contest.show_votes then ' contest__voting-star--dark-bg' else ''}",
        el Contest.Voting.Voter, key: @props.entry.id, entry: @props.entry, waitingForResponse: @props.waitingForResponse, selected: @props.selected, contest: @props.contest

      if @props.contest.show_votes
        if @props.contest.best_of
          div className:'contest__vote-count contest__vote-count--no-percentages',
            osu.transChoice 'contest.vote.points', @props.entry.results.votes
        else
          div className:'contest__vote-count',
            osu.transChoice 'contest.vote.count', @props.entry.results.votes
            if isFinite(votePercentage)
              " (#{votePercentage}%)"
