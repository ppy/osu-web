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
{div, span, a, i} = React.DOM
el = React.createElement

class Contest.Voting.ArtEntry extends React.Component
  render: ->
    votingOver = moment(@props.contest.voting_ends_at).diff() <= 0
    selected = _.includes @props.selected, @props.entry.id
    showVotes = @props.contest.show_votes
    orientation = @props.contest.orientation

    if showVotes
      votePercentage = _.round((@props.entry.results.votes / @props.totalVotes)*100, 2)
      place = @props.displayIndex + 1
      top3 = place <= 3

    topClass = [
      'contest-art-list__entry',
      'contest-art-list__entry--result' if showVotes,
      'contest-art-list__entry--placed' if showVotes && top3,
    ]

    if orientation
      topClass.push "contest-art-list__entry--#{orientation}"
      if showVotes
        if top3
          topClass.push "contest-art-list__entry--#{orientation}--placed-#{place}"
        else
          topClass.push "contest-art-list__entry--#{orientation}--smaller"
    else
      if showVotes
        if top3
          topClass.push "contest-art-list__entry--placed-#{place}"
        else
          topClass.push 'contest-art-list__entry--smaller'

    div style: { backgroundImage: "url('#{@props.entry.preview}')" }, className: _.compact(topClass).join(' '),
      a {
        className: _.compact([
          'js-gallery contest-art-list__thumbnail',
          'contest-art-list__entry--selected' if selected,
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
        div className: 'contest-art-list__result',
          div className: _.compact([
            'contest-art-list__result-place',
            'contest-art-list__result-place--top-three' if showVotes && top3
          ]).join(' '),
            if top3
              i className: "fa fa-fw fa-trophy contest-art-list__trophy--#{place}"
            "##{place}"
          div className: 'contest-art-list__result-votes',
            osu.transChoice 'contest.votes', @props.entry.results.votes
          if not isNaN(votePercentage)
            div className: 'contest-art-list__result-votes contest-art-list__result-votes--percentage', "#{votePercentage}%"
