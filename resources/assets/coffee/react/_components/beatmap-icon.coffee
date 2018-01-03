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

{div} = ReactDOMFactories
el = React.createElement

@BeatmapIcon = (props) ->
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
    el Icon, name: "extra-mode-#{mode}"
