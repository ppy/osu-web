# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { button, span } from 'react-dom-factories'
el = React.createElement

export class TrackPreview extends React.Component
  render: ->
    button
      className: 'track-cover-preview js-audio--play js-audio--player'
      type: 'button'
      'data-audio-url': @props.track.preview
      style:
        backgroundImage: osu.urlPresence(@props.track.cover_url)
      span className: 'play-button'
