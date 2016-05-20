###*
*    Copyright 2015 ppy Pty. Ltd.
*
*    This file is part of osu!web. osu!web is distributed with the hope of
*    attracting more community contributions to the core ecosystem of osu!.
*
*    osu!web is free software: you can redistribute it and/or modify
*    it under the terms of the Affero GNU General Public License version 3
*    as published by the Free Software Foundation.
*
*    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
*    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*    See the GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
*
###

{div,i} = React.DOM
el = React.createElement

@BeatmapIcon = React.createClass
  mixins: [React.addons.PureRenderMixin]

  getDefaultProps: ->
    showTitle: true

  render: ->
    beatmap = @props.beatmap

    difficultyRating =
      if @props.overrideVersion?
        @props.overrideVersion
      else
        BeatmapHelper.getDiffRating beatmap.difficulty_rating

    showTitle = @props.showTitle && !@props.overrideVersion?

    mode = if beatmap.convert then 'osu' else beatmap.mode

    div
      className: "beatmap-icon beatmap-icon--#{difficultyRating} beatmap-icon--#{@props.modifier}"
      title: beatmap.version if showTitle
      el Icon, name: "osumode-#{mode}"
