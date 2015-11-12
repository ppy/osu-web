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

{div,a,img,span} = React.DOM
el = React.createElement

class @BeatmapsListing extends React.Component
  render: ->
    beatmaps = []
    return if @props.beatmaps == undefined
    for beatmap in @props.beatmaps
      beatmaps.push el(Panel, beatmap: beatmap, key: beatmap.beatmapset_id)

    div className: ['beatmap-container', ('dimmed' if @props.loading)].join(' '),
      div className: 'view_mode'
      div className: 'listing',
        if beatmaps.length > 0
          beatmaps
        else
          div {},
            img
              src: '/images/layout/unamused.png'
              srcSet: "/images/layout/unamused.png 1x, /images/layout/unamused@2x.png 2x"
              alt: 'no results'
              title: 'no results'
              style:
                paddingTop: '25px'
                paddingRight: '25px'
                marginBottom: '-25px'
            span {}, '... nope, nothing found.'
