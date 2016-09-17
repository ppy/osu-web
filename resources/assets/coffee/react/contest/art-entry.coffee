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
{div, a} = React.DOM
el = React.createElement

class Contest.ArtEntry extends React.Component
  render: ->
    votingOver = moment(@props.contest.ends_at).diff() <= 0
    selected = _.includes @props.selected, @props.entry.id
    div className: 'contest__entry--art', style: { backgroundImage: "url('#{@props.entry.preview}')" },
      a {
        className: "js-gallery contest__art-preview#{if selected then ' contest__entry--selected' else ''}",
        href: @props.entry.preview,
        'data-width': @props.entry.artMeta.width,
        'data-height': @props.entry.artMeta.height,
        'data-gallery-id': "contest-#{@props.contest.id}",
        'data-index': @props.galleryIndex,
      }
      if (@props.voteCount >= @props.contest.max_votes || votingOver) && !selected
        null
      else
        div className: "contest__vote-link-banner#{if selected then ' contest__vote-link-banner--selected' else ''}",
          el Contest.Voter, key: @props.entry.id, entry: @props.entry, waitingForResponse: @props.waitingForResponse, voteCount: @props.voteCount, contest: @props.contest, selected: @props.selected, theme: 'art'
