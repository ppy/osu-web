# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div, table, thead, tbody, tr, th } from 'react-dom-factories'
import TracklistTrack from 'tracklist-track'
el = React.createElement

export class Tracklist extends React.Component
  render: ->
    return null unless @props.tracks.length > 0

    tracks = @props.tracks.map (track) =>
      el TracklistTrack,
        key: track.id,
        track: track,

    div className: 'tracklist js-audio--group',
      table className: 'tracklist__table',
        thead {},
            tr className: 'tracklist__row--header',
                th className: 'tracklist__col tracklist__col--preview', ''
                th className: 'tracklist__col tracklist__col--title', osu.trans('artist.tracklist.title')
                th className: 'tracklist__col tracklist__col--length', osu.trans('artist.tracklist.length')
                th className: 'tracklist__col tracklist__col--bpm', osu.trans('artist.tracklist.bpm')
                th className: 'tracklist__col tracklist__col--genre', osu.trans('artist.tracklist.genre')
                th className: 'tracklist__col tracklist__col--dl',
        tbody {}, tracks
