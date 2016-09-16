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

class Contest.ArtEntry extends React.Component
  render: ->
    votingOver = moment(@props.contest.ends_at).diff() <= 0
    selected = _.includes @props.selected, @props.entry.id

    if @props.contest.show_votes
      votePercentage = _.round((@props.entry.results.votes / @props.totalVotes)*100, 2)

      place = @props.displayIndex + 1
      top3 = place <= 3

    div className: "contest__entry--art#{if top3 then ' contest__entry--placed-' + place else ' contest__entry--smaller-art'}#{if @props.contest.show_votes then ' contest__entry--result' else ''}", style: { backgroundImage: "url('#{@props.entry.preview}')" },
      a {
        className: "js-gallery contest__art-preview#{if selected then ' contest__entry--selected' else ''}#{if place == 2 then ' contest__art-preview--placed-2' else ''}#{if place > 2 then ' contest__entry--smaller-art' else ''}",
        href: @props.entry.preview,
        'data-width': @props.entry.artMeta.width,
        'data-height': @props.entry.artMeta.height,
        'data-gallery-id': "contest-#{@props.contest.id}",
        'data-index': @props.displayIndex,
      }
      if (@props.selected.length >= @props.contest.max_votes || votingOver) && !selected
        null
      else
        div className: "contest__vote-link-banner#{if selected then ' contest__vote-link-banner--selected' else ''}#{if place > 2 then ' contest__vote-link-banner--smaller' else ''}",
          el Contest.Voter, key: @props.entry.id, entry: @props.entry, waitingForResponse: @props.waitingForResponse, voteCount: @props.selected.length, contest: @props.contest, selected: @props.selected, theme: (if place > 2 then 'art-smaller' else 'art')

      if @props.contest.show_votes
        div className: "contest__result contest__result--art",
          div {className: "contest__result-place contest__result-place--art#{if top3 then ' contest__result-place--top-three' else ''}"},
            if top3
              i className: "fa fa-fw fa-trophy contest__tropy--#{place}"
            "##{place}"
          div {className: 'contest__result-votes contest__result-votes--art'}, "#{@props.entry.results.votes} votes"
          if not isNaN(votePercentage)
            div {className: 'contest__result-votes contest__result-votes--art-darker'}, "#{votePercentage}%"
