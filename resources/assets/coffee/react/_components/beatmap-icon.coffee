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


  render: ->
    beatmap = @props.beatmap

    difficultyRating = switch
      when beatmap.difficulty_rating < 1.5 then 'easy'
      when beatmap.difficulty_rating < 2.25 then 'normal'
      when beatmap.difficulty_rating < 3.75 then 'hard'
      when beatmap.difficulty_rating < 5.25 then 'insane'
      else 'expert'

    div
      className: "beatmap-icon beatmap-icon--#{difficultyRating}"
      title: beatmap.version
      el Icon, name: "osumode-#{beatmap.mode}"
