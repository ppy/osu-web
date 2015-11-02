###*
*    Copyright 2015 ppy Pty. Ltd.
*
*    This file is part of osu!web. osu!web is distributed with the hope of
*    attracting more community contributions to the core ecosystem of osu!.
*
*    osu!web is free software: you can redistribute it and/or modify
*    it under the terms of the Affero GNU General Public License as published by
*    the Free Software Foundation, version 3 of the License.
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

window.BeatmapDifficultyIcon = React.createClass
  render: ->
    difficulty = @props.difficulty
    rating = undefined
    mode = undefined

    if difficulty['rating'] <= 1.5
      rating = 'easy'
    else if difficulty['rating'] <= 2.5
      rating = 'normal'
    else if difficulty['rating'] <= 4
      rating = 'hard'
    else if difficulty['rating'] <= 5
      rating = 'insane'
    else
      rating = 'expert'
    switch difficulty['mode']
      when 0
        mode = 'osu'
      when 1
        mode = 'mania'
      when 2
        mode = 'ctb'
      when 3
        mode = 'taiko'
      else
        mode = 'osu'
        break

    div className: 'difficulty-icon ' + rating, title: difficulty.name,
      i className: 'mode-' + mode
