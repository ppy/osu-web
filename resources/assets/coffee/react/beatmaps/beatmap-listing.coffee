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

class Beatmaps.BeatmapsListing extends React.Component
  render: ->
    beatmaps = []
    return if @props.beatmaps == undefined
    for beatmap in @props.beatmaps
      panel = div
        className: 'osu-layout__col osu-layout__col--sm-6 osu-layout__col--lg-4'
        key: beatmap.beatmapset_id
        el BeatmapsetPanel, beatmap: beatmap

      beatmaps.push panel

    div className: ['beatmap-container', ('dimmed' if @props.loading)].join(' '),
      div className: 'view_mode'
      if beatmaps.length > 0
        div className: 'listing osu-layout__col-container osu-layout__col-container--with-gutter',
          beatmaps
      else
        div className: 'text-center',
          img
            src: '/images/layout/beatmaps/not-found.png'
            srcSet: "/images/layout/beatmaps/not-found.png 1x, /images/layout/beatmaps/not-found@2x.png 2x"
            alt: Lang.get("beatmaps.listing.search.not-found")
            title: Lang.get("beatmaps.listing.search.not-found")
            style:
              paddingTop: '25px'
              paddingRight: '25px'
              marginBottom: '-20px'
          span {}, Lang.get("beatmaps.listing.search.not-found-quote")
