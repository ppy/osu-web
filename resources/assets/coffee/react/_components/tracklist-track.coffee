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
    tr className: "tracklist__row#{if @props.track.selected then ' tracklist__row--selected' else ''}",
      td {},
        el TrackPreview, track: @props.track
      td className:'tracklist__title',
        "#{@props.track.title} "
        span className: 'tracklist__version', @props.track.version
      td className: 'tracklist__length', @props.track.length
      td className: 'tracklist__bpm', "#{@props.track.bpm}bpm"
      td className: 'tracklist__genre', @props.track.genre
      td className: 'tracklist__dl',
        if @props.track.osz
          a className: 'tracklist__link', href: @props.track.osz, title: osu.trans('artist.beatmaps.download'),
            i className: 'fa fa-fw fa-cloud-download'
        else
          span className: 'tracklist__link--disabled', title: osu.trans('artist.beatmaps.download-na'),
            i className: 'fa fa-fw fa-cloud-download'
