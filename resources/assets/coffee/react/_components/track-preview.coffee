# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

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
