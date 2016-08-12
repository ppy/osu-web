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
{div,i} = React.DOM
el = React.createElement

class @ContestVoteSummary extends React.Component
  render: ->
    voteSummary = []
    voteSummary.push _.times Math.max(0, @props.maxVotes - @props.voteCount), ->
      div className: "trackplayer__float-right trackplayer__voting-star trackplayer__voting-star--smaller",
        i className: "fa fa-fw fa-star"
    voteSummary.push _.times @props.voteCount, ->
      div className: "trackplayer__float-right trackplayer__voting-star trackplayer__voting-star--smaller trackplayer__voting-star--selected",
        i className: "fa fa-fw fa-star"

    div {},
      voteSummary
