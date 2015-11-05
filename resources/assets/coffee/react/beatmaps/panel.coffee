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

{div,a,i,span} = React.DOM
el = React.createElement

window.Panel = React.createClass
  render: ->
    beatmap = @props.beatmap
    difficulties = []
    if beatmap.difficulties.length > 0
      if beatmap.difficulties.length > 5
        difficulties.push el(BeatmapDifficultyIcon, difficulty: beatmap.difficulties[0])
        difficulties.push span beatmap.difficulties.length - 1
      else
        for difficulty in beatmap.difficulties
          difficulties.push el(BeatmapDifficultyIcon, difficulty: difficulty)

    div href: '/beatmaps/modding/'+beatmap.beatmapset_id, className: 'beatmap object_link shadow-hover', objectid: beatmap.beatmapset_id,
      div className: 'panel',
        div className: 'thumb', style: {backgroundImage: "url(//b.ppy.sh/thumb/#{beatmap.beatmapset_id}l.jpg)"}
        div className: 'thumb_cover', style: {backgroundImage: "url(//b.ppy.sh/thumb/#{beatmap.beatmapset_id}l.jpg)"}
        div className: 'bottom_left',
          div className: 'title',
            span title: beatmap.title, beatmap.title
          div className: 'artist',
            span title: beatmap.artist, beatmap.artist

        div className: 'top_right',
          div className: 'stats',
            div className: 'plays',
              span title: beatmap.play_count,
                beatmap.play_count
              i className: 'fa fa-play-circle'

            div className: 'favourites',
              span title: beatmap.favourite_count,
                beatmap.favourite_count
              i className: 'fa fa-heart'

      div className: 'bottom_left',
        span className: 'hidden', ref: beatmap.beatmapset_id, beatmap.beatmapset_id
        div className: 'creator', dangerouslySetInnerHTML: { __html: Lang.get 'beatmaps.listing.mapped-by', mapper: React.renderToStaticMarkup(a href: '/u/'+beatmap.user_id, beatmap.creator) }
        div className: 'source', beatmap.source

      div className: 'bottom_right show_on_hover',
        a href: 'https://osu.ppy.sh/d/'+beatmap.beatmapset_id, className: 'object_link',
          i className: 'fa fa-download'
        a href: '#', className:'object_link',
          i className:'fa fa-heart'

      div className: 'difficulties', difficulties

      el('paper-shadow', z: '1', animated: 'true')
