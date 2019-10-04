###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

import * as React from 'react'
import { div, a, i } from 'react-dom-factories'
el = React.createElement

export class TrackPreview extends React.Component
  constructor: (props) ->
    super props

    @state =
      playing: false


  componentDidMount: ->
    @eventId = "trackpreview-#{@props.track.id}"
    $.subscribe "osuAudio:initializing.#{@eventId}", @previewPlay
    $.subscribe "osuAudio:ended.#{@eventId}", @previewStop


  componentWillUnmount: ->
    $.unsubscribe ".#{@eventId}"


  render: ->
    div className: 'tracklist__cover', style: { backgroundImage: osu.urlPresence(@props.track.cover_url) },
      a
        className: 'tracklist__preview js-audio--play'
        href: '#'
        'data-audio-url': @props.track.preview
        i className: "fas #{if @state.playing then 'fa-pause' else 'fa-play'}"


  previewPlay: (_e, {url}) =>
    if url != @props.track.preview
      return @previewStop()

    @setState playing: true


  previewStop: (e) =>
    return if !@state.playing

    @setState playing: false
