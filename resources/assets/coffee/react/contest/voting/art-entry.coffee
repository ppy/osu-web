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

{div, span, a, i} = ReactDOMFactories
el = React.createElement

class Contest.Voting.ArtEntry extends React.Component
  render: ->
    votingOver = moment(@props.contest.voting_ends_at).diff() <= 0
    selected = _.includes @props.selected, @props.entry.id
    showVotes = @props.contest.show_votes
    shape = @props.contest.shape

    if showVotes
      votePercentage = _.round((@props.entry.results.votes / @props.totalVotes)*100, 2)
      place = @props.displayIndex + 1
      top3 = place <= 3

    divClasses = [
      'contest-art-entry',
      'contest-art-entry--result' if showVotes,
      "contest-art-entry--placed contest-art-entry--placed-#{place}" if showVotes && top3,
      'contest-art-entry--smaller' if showVotes && !top3,
      "contest-art-entry--#{shape}" if shape
    ]

    div style: { backgroundImage: "url('#{@props.entry.artMeta.thumb}')" }, className: _.compact(divClasses).join(' '),
      a {
        className: _.compact([
          'js-gallery contest-art-entry__thumbnail',
          'contest-art-entry--selected' if selected,
        ]).join(' '),
        href: @props.entry.preview,
        'data-width': @props.entry.artMeta.width,
        'data-height': @props.entry.artMeta.height,
        'data-gallery-id': "contest-#{@props.contest.id}",
        'data-index': @props.displayIndex,
      }

      if (@props.selected.length >= @props.contest.max_votes || votingOver) && !selected
        null
      else
        div className: _.compact([
          'contest__vote-link-banner',
          'contest__vote-link-banner--selected' if selected,
          'contest__vote-link-banner--smaller' if showVotes && place > 2
        ]).join(' '),
          el Contest.Voting.Voter,
            key: @props.entry.id,
            entry: @props.entry,
            waitingForResponse: @props.waitingForResponse,
            voteCount: @props.selected.length,
            contest: @props.contest,
            selected: @props.selected,
            theme: if showVotes && place > 2 then 'art-smaller' else 'art'

      if showVotes
        div className: 'contest-art-entry__result',
          div className: 'contest-art-entry__result-ranking',
            div className: 'contest-art-entry__result-place',
              if top3
                i className: "fas fa-fw fa-trophy contest-art-entry__trophy--#{place}"
              span {}, "##{place}"
            if @props.entry.results.user_id
              a
                className: 'contest-art-entry__entrant js-usercard',
                'data-user-id': @props.entry.results.user_id,
                href: laroute.route('users.show', user: @props.entry.results.user_id),
                  @props.entry.results.username
            else
              span className: 'contest-art-entry__entrant', @props.entry.results.actual_name
          div className: 'contest-art-entry__result-pane',
            span className: 'contest-art-entry__result-votes',
              osu.transChoice 'contest.vote.count', @props.entry.results.votes
            if not isNaN(votePercentage)
              span className: 'contest-art-entry__result-votes contest-art-entry__result-votes--percentage', " (#{votePercentage}%)"
