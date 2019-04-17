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
import { div, table, thead, tbody, tr, th } from 'react-dom-factories'
import { TracklistTrack } from 'tracklist-track'
el = React.createElement

export class Tracklist extends React.Component
  render: ->
    return null unless @props.tracks.length > 0

    tracks = @props.tracks.map (track) =>
      el TracklistTrack,
        key: track.id,
        track: track,

    div className: 'tracklist',
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
