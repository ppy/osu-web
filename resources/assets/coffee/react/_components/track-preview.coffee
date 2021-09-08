# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { a, div, span } from 'react-dom-factories'
el = React.createElement

export class TrackPreview extends React.Component
  render: ->
    div className: 'tracklist__cover', style: { backgroundImage: osu.urlPresence(@props.track.cover_url) },
      a
        className: 'tracklist__preview js-audio--play js-audio--player'
        href: '#'
        'data-audio-url': @props.track.preview
        span className: 'play-button'
