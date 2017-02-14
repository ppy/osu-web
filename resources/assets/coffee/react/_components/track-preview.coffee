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

{div, a, i} = React.DOM
el = React.createElement

class @TrackPreview extends React.Component
  constructor: (props) ->
    super props

    @state =
      playing: false


  componentDidMount: ->
    @eventId = "trackpreview-#{@props.track.id}"
    $.subscribe "osuAudio:playing.#{@eventId}", @previewPlay
    $.subscribe "osuAudio:ended.#{@eventId}", @previewStop


  componentWillUnmount: ->
    $.unsubscribe ".#{@eventId}"


  render: ->
    if @props.track.cover_url && !@props.track.album_id
      coverStyle = backgroundImage: "url('#{@props.track.cover_url}')"

    div className: 'tracklist__cover', style: coverStyle,
      a
        className: 'tracklist__preview js-audio--play'
        href: '#'
        'data-audio-url': @props.track.preview
        el Icon,
          name: if @state.playing then 'pause' else 'play'
          modifier: ['fw']


  previewPlay: (_e, {url}) =>
    if url != @props.track.preview
      return @previewStop()

    @setState playing: true


  previewStop: (e) =>
    return if !@state.playing

    @setState playing: false
