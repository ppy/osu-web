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

{a, i, span, tr, td} = React.DOM
el = React.createElement

class @TracklistTrack extends React.Component
  render: ->
    tr className: "trackplayer__row#{if @props.track.selected then ' trackplayer__row--selected' else ''}",
      td {},
        el TrackPreview, track: @props.track
      td className:'trackplayer__title',
        "#{@props.track.title} "
        span className: 'trackplayer__version', @props.track.version
      td className: 'trackplayer__length', @props.track.length
      td className: 'trackplayer__bpm', "#{@props.track.bpm}bpm"
      td className: 'trackplayer__genre', @props.track.genre
      td className: 'trackplayer__dl',
        if @props.track.osz
          a className: 'trackplayer__link', href: @props.track.osz, title: 'Download Beatmap Template',
            i className: 'fa fa-fw fa-cloud-download'
        else
          span className: 'trackplayer__link--disabled', title: 'Beatmap Template not yet available',
            i className: 'fa fa-fw fa-cloud-download'
