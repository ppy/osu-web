# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { a, i, span, tr, td } from 'react-dom-factories'
import TrackPreview from 'track-preview'
el = React.createElement

export class TracklistTrack extends React.Component
  render: ->
    tr className: "tracklist__row#{if @props.track.selected then ' tracklist__row--selected' else ''}",
      td {},
        el TrackPreview, track: @props.track
      td className: "tracklist__title#{if @props.track.exclusive then ' tracklist__title--exclusive' else ''}",
        i className: 'fal fa-fw fa-extra-osu tracklist__exclusive-icon', title: osu.trans('artist.songs.original') if @props.track.exclusive
        span className: 'tracklist__name u-ellipsis-overflow',
          "#{@props.track.title} "
          span className: 'tracklist__version', @props.track.version
        if @props.track.is_new
          span className: 'tracklist__new',
            span className: 'pill-badge pill-badge--yellow pill-badge--with-shadow', osu.trans('common.badges.new')

      td className: 'tracklist__length', @props.track.length
      td className: 'tracklist__bpm', "#{@props.track.bpm}bpm"
      td className: 'tracklist__genre u-ellipsis-overflow', @props.track.genre
      td className: 'tracklist__dl',
        if @props.track.osz
          a className: 'tracklist__link', href: @props.track.osz, title: osu.trans('artist.beatmaps.download'),
            i className: 'fas fa-fw fa-download'
        else
          span className: 'tracklist__link--disabled', title: osu.trans('artist.beatmaps.download-na'),
            i className: 'fas fa-fw fa-download'
