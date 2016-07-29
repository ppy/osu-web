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

{div,a,i,span,table,thead,tbody,tr,th,td,audio} = React.DOM
el = React.createElement

class @Track extends React.Component
  playPreview: =>
    $.publish 'tracklist:click', id: @props.track.id

  render: ->
    tr className: 'tracklisting__row',
      td className: 'tracklisting__cover', style: { backgroundImage: "url('#{@props.track.cover_url}')" },
        a className: 'tracklisting__preview', onClick: @playPreview,
          i className: "fa fa-fw #{if @props.playing then 'fa-pause' else 'fa-play'}"
          audio id: "track-#{@props.track.id}-audio", src: @props.track.preview, preload: 'none'
      td className:'tracklisting__title',
        "#{@props.track.title} "
        span className: 'tracklisting__version', @props.track.version
      td className:'tracklisting__bpm', "#{@props.track.bpm}bpm"
      td className:'tracklisting__genre', @props.track.genre
      td className:'tracklisting__dl',
        a className: 'tracklisting__link', href: @props.track.osz,
          i className: 'fa fa-fw fa-cloud-download'

class @Tracklist extends React.Component

  constructor: (props) ->
    super props
    @state = currently_playing: null

  stopTrack: (id) ->
    $("#track-#{id}-audio")[0].pause()

  playTrack: (id) ->
    ele = $("#track-#{id}-audio")[0]
    ele.currentTime = 0
    ele.play()

  handleClick: (_e, {id}) =>
    if @state.currently_playing != null
      @stopTrack @state.currently_playing
      if @state.currently_playing == id
        justPause = true
      @setState currently_playing: null

    if not justPause
      @setState currently_playing: id, ->
        @playTrack id

  componentDidMount: ->
    $.subscribe 'tracklist:click.tracklist', @handleClick

  componentWillUnmount: ->
    $.unsubscribe '.tracklist'

  render: ->
    return null unless @props.tracks.length > 0

    tracks = @props.tracks.map (track) =>
      el Track, key: track.id, track: track, playing: track.id == @state.currently_playing

    div className: 'artist__tracklisting',
      table className: 'tracklisting__table',
        thead {},
            tr className: 'tracklisting__row--header',
                th {}, ''
                th {}, 'title'
                th {}, 'bpm'
                th {}, 'genre'
                th style: { width: '32px' }
        tbody {}, tracks
