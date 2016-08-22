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
{a,i,tr,td} = React.DOM
el = React.createElement

class Contest.Entry extends React.Component
  render: ->
    tr className: "trackplayer__row#{if @props.track.selected then ' trackplayer__row--selected' else ''}",
      if @props.options.showPreview
        td {},
          el TrackPreview, track: @props.track
      if @props.options.showDL
        td className: 'trackplayer__dl trackplayer__dl--contest',
          a className: 'trackplayer__link trackplayer__link--contest-dl', href: '#', title: 'Download Beatmap Template',
            i className: 'fa fa-fw fa-cloud-download'
      td className:'trackplayer__title',
        "#{@props.track.title} "

      td className:'trackplayer__vote',
        el Contest.Voter, key: @props.track.id, track: @props.track, waitingForResponse: @props.waitingForResponse, voteCount: @props.voteCount, maxVotes: @props.options.maxVotes, contest: @props.contest
