###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import * as React from 'react'
import { div, i } from 'react-dom-factories'
el = React.createElement

export BeatmapIcon = (props) ->
  beatmap = props.beatmap

  difficultyRating = props.overrideVersion ? BeatmapHelper.getDiffRating(beatmap.difficulty_rating)
  showTooltip = (props.showTitle ? true) && !props.overrideVersion?
  mode = if beatmap.convert then 'osu' else beatmap.mode

  className = "beatmap-icon beatmap-icon--#{difficultyRating} beatmap-icon--#{props.modifier}"
  className += " beatmap-icon--with-hover js-beatmap-tooltip" if showTooltip

  div
    className: className
    'data-beatmap-title': beatmap.version if showTooltip
    'data-stars': _.round beatmap.difficulty_rating, 2
    'data-difficulty': difficultyRating
    div className: 'beatmap-icon__shadow'
    i className: "fal fa-extra-mode-#{mode}"
