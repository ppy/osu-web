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

{div,a} = React.DOM
el = React.createElement

window.BeatmapsListing = React.createClass
  render: ->
    beatmaps = []
    return if @props.beatmaps == undefined
    for beatmap in @props.beatmaps
      beatmaps.push el(Panel, beatmap: beatmap)

    div className: ['beatmap-container', ('dimmed' if @props.loading)].join(' '),
      div className: 'sorting',
        a href: '#', 'title'
        a href: '#', 'artist'
        a href: '#', 'creator'
        a href: '#', 'difficulty'
        a href: '#', 'ranked'
        a href: '#', className: 'active', 'rating'
        a href: '#', 'plays'
      div className: 'view_mode'
      div className: 'listing',
        beatmaps
