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

{div, a, i, audio} = React.DOM
el = React.createElement

class @TrackPreview extends React.Component
  constructor: (props) ->
    super props
    @state =
      playing: false

  previewStop: (e) =>
    @setState playing: false

  previewPlay: (e) =>
    e.preventDefault()
    justPause = @state.playing
    $.publish 'trackpreview:stop'

    if not justPause
      @setState playing: true, ->
        ele = $("#track-#{@props.track.id}-audio")[0]
        ele.load()
        ele.play()

  previewDone: (e) =>
    @setState playing: false

  componentDidMount: ->
    $.subscribe "trackpreview:stop.trackpreview-#{@props.track.id}", @previewStop

  componentWillUnmount: ->
    $.unsubscribe ".trackpreview-#{@props.track.id}"

  render: ->
    coverStyle = if not @props.track.album_id then { backgroundImage: "url('#{@props.track.cover_url}')" }

    div className: 'tracklist__cover', style: coverStyle,
      a className: 'tracklist__preview', href: '#', onClick: @previewPlay,
        i className: "fa fa-fw #{if @state.playing then 'fa-pause' else 'fa-play'}"
      audio id: "track-#{@props.track.id}-audio", src: (if @state.playing then @props.track.preview else ''), preload: 'none', onEnded: @previewDone
